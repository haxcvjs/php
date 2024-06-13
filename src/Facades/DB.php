<?php 

namespace Core\Facades;

use Core\Database\Database;


class DB extends Facades {
    
    public static  function getInstance() {

        return Database::class;
    }
}

?>