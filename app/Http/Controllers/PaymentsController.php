<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Notifications;
use App\Models\Payment;
use App\Providers\Web3Providers\FackerTatum;
use App\Providers\Web3ServiceProvider;
use Core\Facades\User;
use Core\Http\Request;
use Core\Http\Response;

class PaymentsController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
        app(Payment::class)->syncBalance();
    }

    public function index(Request $request)
    {


        $payments = app(Payment::class)
            ->where('user_id', '=', User::get('id'))
            ->orderBy('id')
            ->where(function ($db) use ($request) {

                if ($request->query('type')) {
                    $db->where("entry", '=', $request->query('type'));
                }
            })->paginate(20);



        $data = [
            'payments' => $payments,
            'type' => $request->query('type'),
            'balance' => app(Payment::class)->Balance()
        ];




        return view('Dashboard.payments', compact('data'));
    }

    public function payments(Request $request)
    {
        $payments = app(Payment::class)
            ->index('user_id')
            ->limit(5)
            ->orderBy('id')
            ->where(function ($db) use ($request) {

                if ($request->query('type')) {
                    $db->where("entry", '=', $request->query('type'));
                }
            })->fetch();




        $data = [
            'payments' => $payments,
            'type' => $request->query('type'),
            'balance' => app(Payment::class)->Balance()
        ];

        return view('Dashboard.balance', compact('data'));
    }

    public function team(Request $request)
    {
        $payments = app(Payment::class)
            ->index('user_id')
            ->limit(5)
            ->orderBy('id')
            ->where(function ($db) use ($request) {


                $db->where("entry", '=', 'rebet');
            })->paginate(2);




        $data = [
            'payments' => $payments,
            'type' => $request->query('type'),
            'balance' => app(Payment::class)->Balance()
        ];

         

        return view('Dashboard.team', compact('data'));
    }


    public function withdraw(Request $request)
    {

        $amount = $request->amount;
        $address = $request->address;
        $password = $request->password;

        $balance = app(Payment::class)->Balance();
        $user = User::get();


        if ($amount <= 10) {
            return json_encode([
                'error' => 1,
                'message' => 'min withdrawal Amount : 10 USDT'
            ]);
        }

        if ($amount > $balance['withdrawBalance']) {
            return json_encode([
                'error' => 1,
                'message' => 'Amount is more than withdrawals Credit ' . $balance['withdrawBalance'] . ' USDT'
            ]);
        }

        if ($password != $user['password']) {
            return json_encode([
                'error' => 1,
                'message' => 'incorrect password'
            ]);
        }

        app(Payment::class)->insert([
            'user_id' => $user['id'],
            'entry' => 'withdraw',
            'type' => 'external',
            'address' => $address,
            'created_at' => date("Y-m-d H:i:s"),
            'amount'  => $amount
        ]);

        $crypto = app()->make(Web3ServiceProvider::class, function (): Web3ServiceProvider {
            return new Web3ServiceProvider(new FackerTatum);
        });

        $crypto->send('', $address, ($amount - 1));

        app(Notifications::class)->insert([
            'user_id' => $user['id'],
            'title' => 'Withdraw',
            'body' => __('You have Withdrawed <b>' . $amount . '</b> ' . currency('USDT') . ' successfully  sent to ' . $address)
        ]);


        return json_encode([
            'error' => 0,
            'message' => __('You have Withdrawed <b>' . $amount . '</b> ' . currency('USDT') . ' successfully  sent to ' . $address)
        ]);



        //return view('Dashboard.balance', compact('data'));
    }
}
