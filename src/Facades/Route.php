<?php 

namespace Core\Facades;

use Core\Router\Router;

class Route extends Facades {
    
    public static  function getInstance() {

        return Router::class;
    }
}

?>