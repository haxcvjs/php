<?php

namespace App\Models;

use App\Providers\Web3Providers\FackerTatum;
use App\Providers\Web3Providers\Tatum;
use App\Providers\Web3ServiceProvider;
use Core\Database\Model;
use PDO;

class AccountModel extends Model
{
     
    protected $table = 'users';
 
     

    public function isEmail($email = '')
    {

        $statement = $this->db->query("SELECT email FROM $this->table WHERE email='$email' ");

        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            if ($email == $row['email']) {
                return true;
            }
        }
    }

    public function isAddress($address = '')
    {

        $statement = $this->db->query("SELECT address FROM $this->table WHERE address='$address' ");

        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            if ($address == $row['address']) {
                return true;
            }
        }
    }

    public function isPrivateKey($private_key = '')
    {

        $statement = $this->db->query("SELECT private_key FROM wallets WHERE private_key='$private_key' ");

        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            if ($private_key == $row['private_key']) {
                return true;
            }
        }
    }

    public function signup($data = [])
    {
        $fullname = $data['fullname'];
        $email = $data['email'];
        $password = $data['password'];
        $code = $data['code'];
        $team_code = mb_substr(str_shuffle('0123456ABCDEF') , 0 , 6);
        // check if Email exists


        if ($this->isEmail($email)) {
            return array(
                'error' => 1,
                'message' => __('Email is already exists')
            );
        }

        // check if Address
        $crypto = app()->make(Web3ServiceProvider::class, function (): Web3ServiceProvider {
            return new Web3ServiceProvider( (app('config.app')['env'] == 'development' ? new FackerTatum : new Tatum));
        });
        
        $wallet = $crypto->CreateWallet();
         
        if(!is_object($wallet)) {
            return array(
                'error' => 1,
                'message' => __('Error try Again: faild to create Wallet')
            );
        }
        
        if(!property_exists($wallet, 'xpub') || !property_exists($wallet, 'mnemonic')) {
            return array(
                'error' => 1,
                'message' => __('Error try Again: faild to create Wallet')
            );
        }

        if(!$wallet->xpub || !$wallet->mnemonic) {
            return array(
                'error' => 1,
                'message' => __('Error try Again: faild to create Wallet')
            );
        }
        
        $address = $crypto->GenerateAddress((string) $wallet->xpub, 1);

        if(!$address) {
            return array(
                'error' => 1,
                'message' => __('Error try Again: faild to create Wallet')
            );
        }

        $key = $crypto->GeneratePrivateKey(1, $wallet->mnemonic);

        if(!$key) {
            return array(
                'error' => 1,
                'message' => __('Error try Again: faild to create Wallet')
            );
        }


        $walletID = app(Wallet::class)->insert([
            'mnemonic' => $wallet->mnemonic,
            'xpub' => $wallet->xpub,
            'private_key' => $key,
            'address' => $address
        ]);
        // check if Wallet created

        if (!$walletID) {
            return array(
                'error' => 1,
                'message' => __('Error try Again')
            );
        }

        $statement = $this->db->prepare("INSERT INTO $this->table  (fullname,team_code,email,password,address,code,wallet_id ) VALUES (?,?,?,?,?,?,?) ");

        $statement->execute([
            $fullname,
            $team_code,
            $email,
            $password,
            $address,
            $code,
            $walletID
        ]);


        $ID = $this->db->lastInsertId();

        if ($ID) {

            return array(
                'error' => 0,
                'message' => 'success',
                'id' => $ID
            );
        }
    }

    public function login($data = [])
    {
        $email = $data['email'];
        $password = $data['password'];

        // check if Email exists


        $statement = $this->db->query("SELECT id FROM $this->table WHERE email='$email' AND password='$password' ");

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $result = $row !== false ? $row['id'] : false;

        if (!$result) {
            return array(
                'error' => 1,
                'message' => 'incorrect Email or Password'
            );
        }


        $ID = $row['id'];

        return array(
            'error' => 0,
            'message' => 'logged successfully',
            'id' => $ID
        );
    }
}
