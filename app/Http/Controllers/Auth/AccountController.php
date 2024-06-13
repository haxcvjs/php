<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controller;
use App\Models\AccountModel;
use App\Providers\Web3Providers\FackerTatum;
use App\Providers\Web3ServiceProvider;
use Core\Database\Connection;
use Core\Facades\User;
use Core\Http\Request;
use Core\Http\Response;
use Core\Tools\Cookie;
use Core\Tools\Session;

class AccountController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function settings(Request $request, Connection $db)
    {

        $user = User::get();

        return view('Dashboard.settings', compact('user'));
    }


    public function index(Request $request, Connection $db)
    {
        if (isset($_SESSION['login'])) {
            redirect('/dashboard');
        }
        return view('Web.auth.login');
    }

    public function recover(Request $request, Connection $db)
    {

        if ($request->getMethod() == 'POST') {

            if (!$request->email) {
                return json_encode([
                    'error' => 1,
                    'message' => 'Email is Required'
                ]);
            }

            $email = User::index('email', $request->email)->get();

            if (!$email) {
                return json_encode([
                    'error' => 1,
                    'message' => 'Email Doesn\'t exists'
                ]);
            }

            $hash = pwd_hash(time());
            User::where('email', '=', $request->email)->update([
                'recovery_code' => $hash,
                'recovery_time' => strtotime("+10 seconds", time())
            ]);

            return json_encode([
                'error' => 0,
                'message' => $hash . ' Recovery Link has been to Your Email check your inbox, spam Folder Expiers after 15 minutes'
            ]);
        }

        return view('Web.auth.recovery');
    }

    public function reset($recovery = '', Request $request, Connection $db)
    {

        $code = User::index('recovery_code', $recovery)->get();




        if ($request->getMethod() == 'POST') {

            if (!$code) {
                return json_encode([
                    'error' => 1,
                    'message' => 'Code Doesn\'t exists'
                ]);
            }

            $password = $request->password;
            $confirm_password = $request->confirm_password;


            if ($password != $confirm_password) {
                return json_encode([
                    'error' => 1,
                    'message' => 'Passwords Doesn\'t Matches'
                ]);
            }



            if ($code['recovery_time'] < time()) {
                return json_encode([
                    'error' => 1,
                    'message' => 'Expired Recovery code'
                ]);
            }

            User::where('recovery_code', '=', $recovery)->update([
                'password' => $password,
                'recovery_time' => time(),
                'recovery_code' => ''
            ]);

            return json_encode([
                'error' => 0,
                'message' => 'Password reseted successfully'
            ]);
        }

        if (!$code || $code['recovery_time'] < time()) {
            return view('Web.auth.recovery');
        }

        return view('Web.auth.reset', ['code' => $recovery]);
    }

    public function updateInfo(Request $request) {

        $fullname = $request->fullname;
        $email = $request->email;

    
        
        
        if (preg_replace("/\s+/" , "" , $email) === '' || preg_replace("/\s+/" , "" , $fullname) === ''  ) {
            return json_encode([
                'error' => 1,
                'message' => __('All Fields Are Required')
            ]);
        }
        
        
      
        if (strlen(preg_replace("/\s+/" , "" , $fullname)) < 6 ) {
            return json_encode([
                'error' => 1,
                'message' => __('fullname  is short min digits 6 ')
            ]);
        }
        
        $isEmail = User::setIndex('')->where('email', '=', $email)->where('id', '!=', Cookie::get('uid'))->get();

       
        if($isEmail) {
            return json_encode([
                'error' => 1,
                'message' => __(' Email is already in use ')
            ]);
        }




        if(User::index('id' , Cookie::get('uid'))->update([ 'email' => $email, 'fullname' => $fullname ]) > 0) {
            return json_encode([
                'error' => 0,
                'message' => 'Updated successfully'
            ]);
        }
        
        return json_encode([
            'error' => 0,
            'message' => __('Updated successfully but You changed nothing ;)')
        ]);   
    }

    public function updatePassword(Request $request)
    {

        
        
        
        $password = $request->password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        
        
        if (preg_replace("/\s+/" , "" , $password) === '' || preg_replace("/\s+/" , "" , $new_password) === '' || preg_replace("/\s+/" , "" , $confirm_password) === '' ) {
            return json_encode([
                'error' => 1,
                'message' => __('Passwords Are Required')
            ]);
        }
        
        
        if ($new_password != $confirm_password) {
            return json_encode([
                'error' => 1,
                'message' => __('Passwords Doesn\'t Matches')
            ]);
        }
        
        if (strlen(preg_replace("/\s+/" , "" , $new_password)) < 6 ) {
            return json_encode([
                'error' => 1,
                'message' => __('password is short min digits 6 ')
            ]);
        }
        
        $user = User::where('password', '=', $password)->get();

        if(!$user) {
            return json_encode([
                'error' => 1,
                'message' => __(' incorrect Password')
            ]);
        }




        User::where('id' , '=' , $user['id'])->update([
            'password' => $new_password,
        ]);

        return json_encode([
            'error' => 0,
            'message' => 'Password reseted successfully'
        ]);
    }

    public function login(Request $request)
    {

        $username = $request->{'email-username'};
        $password = $request->password;

        $account = new AccountModel;
        $sign = $account->login(
            [
                'email' => $username,
                'password' => $password,
            ]
        );


        if (isset($sign['error']) && $sign['error'] == 0) {
            $this->createSession($sign['id']);
            if (!isAjax()) {
                redirect(route('dashboard.home'));
                return;
            }
        }

        return json_encode($sign);
    }

    public function register(Request $request)
    {

        $fullname = $request->fullname;
        $email = $request->{'email-username'};
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $code = $request->code;




        $account = new AccountModel;
        $sign = $account->signup(
            [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password,
                'code' => $code
            ]
        );

        if (isset($sign['error']) && $sign['error'] == 0) {
            $this->createSession($sign['id']);
            if (!isAjax()) {
                redirect(route('dashboard.home'));
                return;
            }
        }
        return json_encode($sign);
    }

    public function signup2($ID, Request $request)
    {

        if ($this->isLoggedIn()) {
            redirect(route('dashboard.home'));
        }
        return view('Web.auth.signup', ['code' => $ID]);
    }

    public function signup(Request $request)
    {

        if ($this->isLoggedIn()) {
            redirect(route('dashboard.home'));
        }
        return view('Web.auth.signup');
    }

    public function createSession($id=null)
    {
        if(!$id) return;
        Cookie::set('uid' , $id, time() + 10000000);
        Cookie::set('accessToken' , base64_encode(md5(time())), time() + 10000000);
    }
    
    public function destroySession()
    {
        Cookie::set('uid' , null, time() - 1);
        Cookie::set('accessToken' , null, time() -1);
    }
    
    public function isLoggedIn()
    {
        return Cookie::get('uid') && Cookie::get('accessToken');
    }
}
