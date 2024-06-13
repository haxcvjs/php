<?php

namespace App\Models;


use Core\Database\Model;
use Core\Tools\Cookie;
use Core\Tools\Session;
 

class Order extends Model
{
  
    
    protected $table = 'orders';
    protected $index = 'id';

    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }
    
     
   
    
}
