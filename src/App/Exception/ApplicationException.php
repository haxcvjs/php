<?php

namespace Core\App\Exception;
use Exception;

class ApplicationException extends Exception {
    
    public function __construct() {
        parent::__construct('The given data was invalid.');
    }
}