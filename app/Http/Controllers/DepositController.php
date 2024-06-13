<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Plans;
use App\Providers\Web3Providers\FackerTatum;
use App\Providers\Web3Providers\Tatum;
use App\Providers\Web3ServiceProvider;
use Core\Database\Connection;
use Core\Database\Database;
use Core\Facades\DB;
use Core\Facades\User;
use Core\Http\Request;
use Core\Http\Response;
use Core\Tools\Config;

class DepositController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function verify(Request $request)
    {
        return json_encode(app(Payment::class)->syncBalance());
    }

    public function index(Request $request, Connection $db)
    {


        $user = User::get();

        if ($request->query('order')) {
            $PlanID = $request->query('order');
            // check user
            if ($user) {
                // check plans
                $plan = app(Plans::class)->setIndexValue($PlanID)->get();

                if ($plan) {


                    if ($plan['id'] > $user['plan']) {

                        //check order 
                        $order = app(Order::class)
                            ->index('plan_id', $plan['id'])
                            ->where(function ($db) use ($request, $user, $plan) {
                                $db->where("user_id", '=', $user['id']);
                            })->get();

                        if (!$order) {
                            app(Order::class)->insert([
                                'user_id' => $user['id'],
                                'plan_id' => $plan['id'],
                                'plan_id' => $plan['id'],
                                'amount'  => $plan['price']
                            ]);
                        } else {
                            app(Order::class)->where(function ($db) use ($user, $plan, $order) {
                                $db->where('id', '=', $order['id']);
                                $db->where('plan_id', '=', $plan['id']);
                                $db->where('user_id', '=', $user['id']);
                            })->update([
                                'status' => 0,
                                'amount' => $plan['price'],
                                'update_at' => date("Y-m-d H:i:s")
                            ]);
                        }
                        return  redirect(route('dashboard.deposit'));
                    }
                }
            }
        }



        return view('Dashboard.deposit', compact('user'));
    }
}
