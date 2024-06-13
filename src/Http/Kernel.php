<?php

namespace Core\Http;

use Core\App\Application;
use Core\Facades\Route;
use Core\Router\Router;
use Core\Router\RouterHelper;

class Kernel
{

    protected $currentMiddlewareGroups = [];

    protected $MiddlewareGroups = [];

    protected $currentMiddlewareCallback = [];

    public $currentMethod;

    public $afterRoute = false;

    protected $MiddlewarePiorityGroups = [
        \Core\Http\Middleware\HttpSecurity::class,
        \Core\Http\Middleware\Firewall::class
    ];

    

    public function __construct(public Application $app, protected Router $router)
    {
         
    }

    public function middleware($callback = null)
    {

        

        if (is_array($callback)) {
            foreach ($callback as $Middleware) {
                if (!isset($this->MiddlewareGroups[$Middleware])) {
                    $this->MiddlewareGroups[] = $Middleware;
                }
            }
        } else {
            if (!isset($this->MiddlewareGroups[$callback])) {
                $this->MiddlewareGroups[] = $callback;
            }
        }

         

        return $this;
    }
    
    public function currentMethod($method = [] )
    {
 
        $this->currentMethod = $method;
         

        return $this;
    }
    
    public function currentMiddleware($middleware = [] )
    {
 
        $this->currentMiddlewareGroups = $middleware;
         

        return $this;
    }
    
    public function currentMiddlewareFunc($concrate = [] )
    {
 
        $this->currentMiddlewareCallback = $concrate;
         

        return $this;
    }



    public function MiddlewareGroupGaurd(array $Middlewares, Request $request)
    {
        $shouldPass = [];
        $shouldNotPass = [];
        

        foreach ( app()->UniqueValues($Middlewares) as $Middleware) {

            $MiddlewareInstance = app()->get($Middleware);


            $handler = $MiddlewareInstance->handle($request, function () {
                return true;
            });

            if ($handler) {
                $shouldPass[] = $Middleware;
            } else {
                $shouldNotPass[] = $Middleware;
            }
        }

        return $shouldNotPass;
    }



    public function MiddlewareGroupGaurds()
    {
        $this->MiddlewareGroups = array_merge($this->MiddlewareGroups , []);
        $this->MiddlewarePiorityGroups = array_merge($this->MiddlewarePiorityGroups ,[]);
    }

    public function handle()
    {

        try {
            
            $response =  $this->sendRequestThroughRouter($this->app->get(Request::class));

        } catch (\Throwable $th) {
           $response =  new Response( view('Web.Error.500' , ['errors' => $th]) ,500);
        }

        return $response;
    }

    /**
     * Send the given request through the middleware / router.
     *
     * @param  \Core\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendRequestThroughRouter($request)
    {

       
        
        $this->bootstrap();
        
        $this->router->dispatch($request);

        $response = $this->router->sendRequest($request);

         //MiddlewarePiorityGroups Middleware Groups
         if ($this->MiddlewareGroupGaurd($this->MiddlewarePiorityGroups, $request)) {
            $response->setContent('');
            return $response;
        }
        
        //system Middleware Groups
        if ($this->MiddlewareGroupGaurd($this->currentMiddlewareGroups, $request)) {
            $response->setContent('');
            return $response;
        }
        
       /*  print_r($this->currentMethod);
        print_r($this->currentMiddlewareCallback); */
        if(array_key_exists('type' , $this->currentMiddlewareCallback)) {
            $result = '';
            
            if($this->currentMiddlewareCallback['type'] == 'instance') {
                $result  = RouterHelper::invokeClass(
                    $this->currentMiddlewareCallback['gateway'],
                    $this->currentMiddlewareCallback['method'],
                    $this->currentMiddlewareCallback['argvs']
                );

                
            } 
            else if($this->currentMiddlewareCallback['type'] == 'method') {
                $result  = RouterHelper::invokeMethod(
                    $this->currentMiddlewareCallback['gateway'],
                    $this->currentMiddlewareCallback['argvs']
                );
            } 


            $response->setContent($result);
        }
       
        
        return $response;
    }


    public function bootstrap()
    {
        $this->app->bootstrap();
    }

    public function terminate()
    {
    }
}
