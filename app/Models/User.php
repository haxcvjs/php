<?php

namespace App\Models;

use Core\Database\Model;
use Core\Tools\Cookie;
use Core\Tools\Session;

class User extends Model
{
    
    
    protected $table = 'users';
    protected $index = 'id';

    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }
   
    
}
