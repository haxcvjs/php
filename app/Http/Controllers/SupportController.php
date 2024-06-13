<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Jad;
use Core\Database\Connection;
use Core\Database\Database;
use Core\Facades\DB;
use Core\Http\Request;
use Core\Http\Response;
use Core\Tools\Config;

class SupportController extends Controller
{


    public function __construct(public Request $request, public Response $response)
    {
    }

    public function index(Request $request, Connection $db)
    {
        return view('Dashboard.support');
    }
}
