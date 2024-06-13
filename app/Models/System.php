<?php

namespace App\Models;
 
use Core\Database\Model;
 

 

class System extends Model
{
    
    
    protected $table = 'system';
    protected $index = 'id';

    public function setup() {
        $this->indexValue = 1;
    }
    
     
   
    
}
