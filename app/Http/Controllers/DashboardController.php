<?php

namespace App\Http\Controllers;

use App\Http\Controller;
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

class DashboardController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function index(Request $request, Connection $db)
    {
        $plans = app(Plans::class)->All();
        $user = User::get();

         

        return view('Dashboard.index', [
            'plans' => $plans,
            'user' => $user,
            'balance' => app(Payment::class)->Balance()
        ]);
    }
    
    public function notifications(Request $request, Connection $db)
    {
        $data = app(Notifications::class)->fetch();

        return view('Dashboard.notifications', compact('data'));
    }
}
