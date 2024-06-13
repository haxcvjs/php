<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Mission;
use App\Models\Notifications;
use App\Models\Payment;
use App\Models\Plans;
use Core\Database\Connection;
use Core\Database\Database;
use Core\Facades\DB;
use Core\Facades\User;
use Core\Http\Request;
use Core\Http\Response;
use Core\Tools\Config;

class MissionController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function doTask(Request $request, Connection $db)
    {

        # date_default_timezone_set('GMT');
        $user = User::get();

        //check order 
        $Mission = app(Mission::class)
            ->index('user_id', $user['id'])
            ->orderBy('id')
            ->limit(1)
            ->where(function ($db) use ($request, $user) {
                #$db->where("user_id", '=', $user['id']);
            })->get();

        $Plan = app(Plans::class)
            ->index('id', $user['plan'] > 0 ? $user['plan'] : 1)
            ->limit(1)
            ->where(function ($db) use ($request, $user) {
                #$db->where("id", '=',  );
            })->get();

        $locked = $user['plan'] < 1;


        if ($locked) {
            return json_encode([
                'error' => 1,
                'message' => __('You need to Upgrade')
            ]);
        }

        $currentTime = strtotime(date("Y-m-d H:i:s"));
        $taskTime = strtotime("+10 seconds", strtotime($Mission['created_at']));

        $timeBlocked = $taskTime >= $currentTime;
 



        if ($timeBlocked) {
            
            return json_encode([
                'error' => 1,
                'message' => __('No Task for Now wait for next for 1 mins')
            ]);

        }

        app(Mission::class)
            ->index('id', $Plan['id'])
            ->update([
                'status' => 1,
                'complete_date' => date("Y-m-d H:i:s"),
            ]);




        app(Mission::class)->insert([
            'user_id' => $user['id'],
            'plan_id' => $Plan['id'],
            'created_at' => date("Y-m-d H:i:s"),
            'complete_date' => date("Y-m-d H:i:s"),
            'status'  => 1
        ]);

        app(Payment::class)->insert([
            'user_id' => $user['id'],
            'entry' => 'earning',
            'type' => 'internal',
            'created_at' => date("Y-m-d H:i:s"),
            'amount'  => $Plan['comission']
        ]);

       



        app(Notifications::class)->insert([
            'user_id' => $user['id'],
            'title' => 'Earning',
            'body' => __('<b>' . $Plan['comission'] .  '</b> USDT has been added to Your Account')
        ]);

        return json_encode([
            'error' => 0,
            'message' => __('Task Completed ' . $Plan['comission'] .  ' USDT has been added to Your Account')
        ]);
    }


    public function index(Request $request, Connection $db)
    {

        # date_default_timezone_set('GMT');
        $user = User::get();

        //check order 
        $Mission = app(Mission::class)
            ->index('user_id', $user['id'])
            ->orderBy('id')
            ->limit(1)
            ->where(function ($db) use ($request, $user) {
                #$db->where("user_id", '=', $user['id']);
            })->get();

        $Plan = app(Plans::class)
            ->index('id', $user['plan'] > 0 ? $user['plan'] : 1)
            ->limit(1)
            ->where(function ($db) use ($request, $user) {
                #$db->where("id", '=',  );
            })->get();

        $locked = $user['plan'] < 1;


        /* if ($locked) {
            return json_encode([
                'error' => 1,
                'message' => __('You need to Upgrade')
            ]);
        } */

        $currentTime = strtotime(date("Y-m-d H:i:s"));
        $taskTime = strtotime("+10 seconds", strtotime($Mission['created_at']));
        $completeTask = strtotime($Mission['complete_date']);
        $nextTask = strtotime("+10 seconds", strtotime($Mission['complete_date']));

        $timeBlocked = $taskTime >= $currentTime;
 



        

        $locked = $user['plan'] < 1;

        $data = [
            'locked' => $locked,
            'mission' => $Mission,
            'completed' => $timeBlocked,
            'next' => ($nextTask-time()),
            'plan' => $Plan
        ];


        return view('Dashboard.mission', compact('data'));
    }
}
