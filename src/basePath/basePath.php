<?php 

namespace Core\basePath;

class basePath {
    public $basePath;
    public function __construct()
    {
        $this->basePath = $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__);
    }
    
    public function getBasePath()
    {
       return  $this->basePath;
    }
}