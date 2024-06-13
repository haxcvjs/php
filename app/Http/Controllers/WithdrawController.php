<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Payment;
use Core\Database\Connection;
use Core\Database\Database;
use Core\Facades\DB;
use Core\Http\Request;
use Core\Http\Response;
use Core\Tools\Config;

class WithdrawController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function index(Request $request, Connection $db)
    {   

        $data = [
            'balance' => app(Payment::class)->Balance()
        ];

        return view('Dashboard.withdraw', compact('data'));
    }
}
