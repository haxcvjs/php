<?php 

namespace Core\Facades;

use Core\View\View as ViewView;

class View extends Facades {
    
    public static  function getInstance() {

        return ViewView::class;
    }
}

?>