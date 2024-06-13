<?php

namespace App\Models;
 
use Core\Database\Model;
use Core\Tools\Cookie;
use Core\Tools\Session;

class Plans extends Model
{
     
    
    protected $table = 'plans';
    protected $index = 'id';

    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }
   
    
}
