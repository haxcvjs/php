<?php 

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Notifications;
use App\Models\Payment;
use Core\Http\Request;

class Connection extends Controller {

    public function seen() {
        (app(Notifications::class)->update(['seen' => '1']));
    }
    
    public function read($ID) {
        (app(Notifications::class)->where('id' ,'=', $ID)->update(['`read`' => '1']));
    }

    public function notification(Request $request) {
        $id = (int) $request->id;
        $data =  (app(Notifications::class)->last_records($id));
        $count =  (app(Notifications::class)->select('COUNT(id) AS noti')->where('seen', '=' ,'0')->get('noti'));
        $last_id = null;
        if($data) {
            $last_id = $data[0]['id'];
        }

        $balance = app(Payment::class)->Balance();
        $balance2 = $balance;
        foreach ($balance as $key => $value) {
            $balance[$key] = number_format($value,2);
        }
        return json_encode([
            'balance' => [
                'formated' => $balance,
                'raw' => $balance2
            ],
            'count' => $count,
            'data' => $data,
            'last_id' => $last_id
        ]);
    }

}