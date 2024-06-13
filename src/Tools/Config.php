<?php 

namespace Core\Tools;

use Core\App\Application;

class Config {

    public function __construct(public Application $app)
    {
        
    }
    
    public function getConfig(string $config = null): array
    {
        if(file_exists($this->app->basePath . '/bootstrap/config/' . $config . '.php')) {
            return (array) require $this->app->basePath . '/bootstrap/config/' . $config . '.php' ?? [];
        }

        return [];
    }

    public function register()
    {
        $this->app->instance('config.app' , $this->getConfig('app'));
        $this->app->instance('config.database' , $this->getConfig('database'));
    }
    
    public function get($config)
    {
        return $this->app->get( 'config.'. $config);
    }
}