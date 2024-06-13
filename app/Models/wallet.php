<?php

namespace App\Models;

 
use Core\Database\Model;
use Core\Tools\Cookie;
use Core\Tools\Session;
 

class Wallet extends Model
{
  
    protected $table = 'wallets';
    protected $index = 'id';

    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }
   
    
}
