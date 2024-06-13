<?php

namespace App\Models;

 
use Core\Database\Model;
use Core\Tools\Cookie;
use Core\Tools\Session;
 

class Notifications extends Model
{
  
    
    protected $table = 'notifications';
    protected $index = 'user_id';

    public function setup() {
        $this->indexValue = Cookie::get('uid');
    }

    //  read 

    // get read 

    // get Latsets records

    public function last_records(int $id) {
        
        $records = $this->where('id' , '>' , $id)->orderBy('id' , 'DESC')->limit(20)->fetch();
        return $records;
    }
    
    // get Latsets records

    public function last_record() {
        
        $record = $this->orderBy('id' , 'DESC')->limit(1)->get();
        return $record;
    }
    
    // get Latsets records ID

    public function last_record_id() {
        
        $record = $this->orderBy('id' , 'DESC')->limit(1)->get('id');
        return $record;
    }

    
     
   
    
}
