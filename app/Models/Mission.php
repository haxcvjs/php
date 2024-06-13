<?php

namespace App\Models;

use App\Providers\Web3Providers\FackerTatum;
use App\Providers\Web3ServiceProvider;
use Core\Database\Connection;
use Core\Database\Model;
use Core\Facades\DB;
use Core\Tools\Cookie;
use Core\Tools\Session;
use PDO;

class Mission extends Model
{
    protected PDO $db;
    
    protected $table = 'missions';
    protected $index = 'id';

    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }
   
    
}
