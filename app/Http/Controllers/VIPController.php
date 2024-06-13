<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Plans;
use Core\Database\Connection;
use Core\Database\Database;
use Core\Facades\DB;
use Core\Facades\User;
use Core\Http\Request;
use Core\Http\Response;
use Core\Tools\Config;

class VIPController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function index(Request $request, Connection $db)
    {
        $plans = app(Plans::class)->All();
        $user = User::get();



        return view('Dashboard.vip', [
            'plans' => $plans,
            'user' => $user
        ]);
    }


   


    public function subscribe(Request $request, Connection $db)
    {

         

        $PlanID = $request->id;
        // check user
        $user = User::get();

        if (!$user) {
            return json_encode([
                'error' => 1,
                'message' => __('Error try Agian')
            ]);
        }

        // check plans
        $plan = app(Plans::class)->setIndexValue($PlanID)->get();

        if (!$plan) {
            return json_encode([
                'error' => 1,
                'message' => __('Plan doesn\'t exists')
            ]);
        }

        if ($plan['id'] <= $user['plan']) {
            return json_encode([
                'error' => 1,
                'message' => __('Please Select Bigger Plan You cannot downgrade ')
            ]);
        }

        



        // check Balance
        $balance = app(Payment::class)->Balance();

        if ($balance['deposit'] < $plan['price']) {
            return json_encode([
                'error' => 1,
                'message' => __('Need to Deposit  ' . $plan['price'] - $balance['deposit'] . '  '. currency('USDT'))
            ]);
        }

        //check order 
        $order = app(Order::class)
            ->index('plan_id', $plan['id'])
            ->where(function ($db) use ($request, $user, $plan) {
                $db->where("user_id", '=', $user['id']);
            })->get();

        if(!$order) {
            app(Order::class)->insert([
                'user_id' => $user['id'],
                'plan_id' => $plan['id'],
                'plan_id' => $plan['id'],
                'amount'  => $plan['price']
            ]);

        } else {
            app(Order::class)->where(function($db) use($user,$plan,$order) {
                $db->where('id', '=', $order['id']);
                $db->where('plan_id', '=', $plan['id']);
                $db->where('user_id', '=', $user['id']);
            })->update([
                'status' => 0,
                'amount' => $plan['price']
            ]);
        }


        app(Order::class)->where(function($db) use($user,$plan,$order) {
            $db->where('id', '=', $order['id']);
            $db->where('plan_id', '=', $plan['id']);
            $db->where('user_id', '=', $user['id']);
        })->update([
            'status' => 1,
            'amount' => $plan['price'],
            'paid_date' => date("Y-m-d H:i:s"),
        ]);

        $expires_date =  date("Y-m-d H:i:s", strtotime("+" . $plan['period']));
         
        
        User::where(function($db) use($user) {
            $db->where('id', '=', $user['id']);
        })->update([
            'plan' => $plan['id'],
            'effective_time' => date("Y-m-d H:i:s "). ' : ' . $expires_date,
            'expire_time' => ($expires_date),
        ]);

        $balance = app(Payment::class)->Balance();

        /* app(Payment::class)->insert([
            'user_id' => $user['id'],
            'entry' => 'Subscribtion',
            'type' => 'external',
            'address' => $plan['name'],
            'created_at' => date("Y-m-d H:i:s"),
            'amount'  => $balance['onhold'] - $balance['deposit']
        ]); */

        app(Notifications::class)->insert([
            'user_id' => $user['id'],
            'title' => 'Package Subscribtion',
            'body' => __('<b> ' . $plan['name'] .'</b> Package has been unlocked successfully   ')
        ]);
        
        return  json_encode([
            'error' => 0,
            'message' => __('<b> ' . $plan['name'] .'</b> Package has been unlocked successfully   ')
        ]);;
    }
    
     
}
