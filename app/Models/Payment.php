<?php

namespace App\Models;

use App\Providers\Web3Providers\FackerTatum;
use App\Providers\Web3ServiceProvider;
use Core\Database\Model;
use Core\Facades\User;
use Core\Tools\Cookie;
use Core\Tools\Session;
 

class Payment extends Model
{
   

    protected $table = 'payments';
    protected $index = 'id';


    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }

    public function entrySum($entry)
    {
        $entry = (array) $this->select(' SUM(amount) AS amount  ')
            ->index('user_id')
            ->where(function ($db) use ($entry) {


                $db->where("entry", '=', $entry);
            })->get();


        if (is_array($entry)) {
            if (array_key_exists('amount', $entry)) {
                return $entry['amount'];
            }
        }
    }

    public function Balance()
    {

        $withdraw = (float) $this->entrySum('withdraw');
        $deposit = (float) $this->entrySum('deposit');
        $earning = (float) $this->entrySum('earning');
        $rebet = (float) $this->entrySum('rebet');

        $user = User::get();
        $plan = app(Plans::class)->index('id',  $user['plan'])->get();
        if($user['plan'] <= 1) {
            $user['price'] = 0;
        }
        
        $planTime = strtotime($user['expire_time']);
        $amount = $plan['price'];
        if ($planTime <= time()) {
            $amount = 0;
        }

         
         

        $funding =     abs($amount - $deposit);



        $withdrawBalance = ($rebet + $earning) - $withdraw;
        $totalBalance = $withdrawBalance + $deposit;

        return [
            'total' => round($totalBalance, 2),
            'withdraw' => round($withdraw, 2),
            'earning' => round($earning, 2),
            'onhold' => round($amount, 2),
            'withdrawBalance' => round($withdrawBalance, 2),
            'deposit' => round($deposit, 2),
            'funding' => round($funding, 2),
        ];
    }

    public function syncBalance()
    {
        $crypto = app()->make(Web3ServiceProvider::class, function (): Web3ServiceProvider {
            return new Web3ServiceProvider(new FackerTatum);
        });

        //
        $lastDeposit = $this->index('user_id')
            ->limit(1)
            ->orderBy('id')
            ->where(function ($db) {

                $db->where("entry", '=', 'deposit');
            })->get();

        $address = User::get('address');

        $records = $crypto->GetTransactions($address);


        $amount = 0;
        if (!$lastDeposit && false) {
            foreach ($records->data as $key => $value) {
                $amount += $value->amount;
            }
        } else {
            foreach ($records->data as $key => $value) {
                $time = strtotime($lastDeposit['created_at']);
                $DepositTime = $value->time;
                if ($DepositTime > $time) {
                    $amount += $value->amount;
                }
            }
        }

        if ($amount <= 0) {
            return [
                'error' => 1,
                'message' => __('No Deposit Found Please wait for 1-3 mintues and try again')
            ];
        }


        $user = User::get();
        $this->insert([
            'user_id' => $user['id'],
            'entry' => 'deposit',
            'type' => 'external',
            'address' => $user['address'],
            'created_at' => date("Y-m-d H:i:s"),
            'amount'  => $amount
        ]);

        if ($amount > 0) {

            app(Notifications::class)->insert([
                'user_id' => $user['id'],
                'title' => 'Deposit',
                'body' => __('You have Deposited <b>' . $amount . '</b> ' . currency('USDT') . ' successfully')
            ]);

            $firstMember = User::index('team_code', $user['code'])->get();
            
            if (array_key_exists('id', $firstMember)) {

                

                $this->insert([
                    'user_id' => $firstMember['id'],
                    'entry' => 'rebet',
                    'type' => 'external',
                    'address' => 'Rebet from <b>' . $user['fullname'] . '</b>',
                    'created_at' => date("Y-m-d H:i:s"),
                    'amount'  => $amount*0.05
                ]);


                /* $secondMember = User::index('team_code', $firstMember['code'])->get();

                if (array_key_exists('id', $secondMember)) {
                    
                    $this->insert([
                        'user_id' => $secondMember['id'],
                        'entry' => 'earning',
                        'type' => 'external',
                        'created_at' => date("Y-m-d H:i:s"),
                        'amount'  => ($amount*0.05)*0.5
                    ]);

                    $thirdMember = User::index('team_code', $secondMember['code'])->get();
                    if (array_key_exists('id', $thirdMember)) {

                        $this->insert([
                            'user_id' => $thirdMember['id'],
                            'entry' => 'earning',
                            'type' => 'external',
                            'created_at' => date("Y-m-d H:i:s"),
                            'amount'  => ($amount*0.05)*0.25
                        ]);
                    }
                } */
            }

            return [
                'error' => 0,
                'message' => __('You have Deposited <b>' . $amount . '</b> ' . currency('USDT') . ' successfully')
            ];
        }
    }
}
