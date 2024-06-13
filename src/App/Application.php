<?php

namespace Core\App;

use Core\Container\Container;
use Core\Facades\Facades;
use Core\Http\Response;
use Core\Tools\Config;

class Application extends Container
{
    public Response $response;
    public $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
        
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->bindPathsInContainer();

        $this->instanceResponse();
        $this->bindConfigContainers();
        $this->registerBaseBindings();
        $this->registerFacade();
    }

    protected function instanceResponse()
    {
        $this->singleton(Response::class, function () {
            return new Response;
        });
    }
    
    protected function bindConfigContainers()
    {
        $config = $this->singleton(Config::class, function () {
             return new Config($this);
        });

        $config->register();
    }

    protected function registerFacade()
    {
        Facades::registerFacade(\Core\View\View::class);
        Facades::registerFacade(\Core\Facades\Route::class);
        Facades::registerFacade(\Core\Facades\DB::class);
        Facades::registerFacade(\Core\Facades\User::class);
        Facades::loadFacades();

        $this->loadRoutes();
    }

    public function loadRoutes()
    {
    }

    protected function registerBaseBindings()
    {
        static::setInstance($this);
    }

    /**
     * Set the base path for the application.
     *
     * @param  string  $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
        return $this;
    }

    /**
     * Bind all of the application paths in the container.
     *
     * @return void
     */
    protected function bindPathsInContainer()
    {
        $this->instance('path.base'       , $this->basePath);
        $this->instance('path.src'       , $this->basePath . '/src');
        $this->instance('path.app'       , $this->basePath . '/app');
        $this->instance('path.views'     , $this->basePath . '/views');
        $this->instance('path.routes'    , $this->basePath . '/routes');
        $this->instance('path.public'    , $this->basePath . '/public');
        $this->instance('path.bootstrap' , $this->basePath . '/bootstrap');
    }

    public function UniqueValues(array $array)
    {
        $current = [];
        foreach ($array as $key) {
            $current[$key] = $key;
        }
        return array_values($current);
    }

    public function bootstrap()
    {
    }
}
