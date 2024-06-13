<?php


namespace Core\Router;

use App\Http\Middleware\WelcomeMiddleware;
use Core\Container\Container;
use Core\Http\Request;
use Core\Http\Response;
use Exception;
use Throwable;

class Router
{

    private Request $currentRequest;

    private $missingPath;
    
    public $name;

    public $kernel;

    private $currentMethod;

    private $MiddlewareGroups = [];

    private $MiddlewarePiorityGroups = [
    ];

    private $currentPath;

    public $currentRoutePath = 'web';

    protected array $routes = [];

    public array $routesPrefix = [
        'groups' => [
            'api' => '/routes/api.php',
            'rest' => '/routes/rest.php'
        ],
        'default' => [
            'web' => '/routes/web.php'
        ]
    ];




    public array $handlers = [
        'GET'  => [],
        'POST' => []
    ];

    protected string $method;

    public function __construct()
    {
    }

    public function get(string $path, $callback)
    {
        $this->addHandler($path, $callback, 'GET');
        return $this;
    }

    public function post(string $path, $callback)
    {
        $this->addHandler($path, $callback, 'POST');
        return $this;
    }

    public function name($callback = null)
    {

        
        foreach ($this->handlers[$this->currentMethod] as $key => $handler) {

            if ($handler->path == $this->currentPath) {
                $this->handlers[$this->currentMethod][$key]->name = $callback;
                $this->routes[$callback] = $this->handlers[$this->currentMethod][$key]->path;
            }
        }
        
        return $this;
    }
    
    public function hasRoute($name = null): bool
    {
       if(array_key_exists($name, $this->routes)) {
            return true;
       }

       return false;
    }
    
    public function getRoute($name = null)
    {
       if(!$this->hasRoute($name)) {
            return;
       }

       return $this->routes[$name];
    }
    
    public function middleware($callback = null)
    {

        
        foreach ($this->handlers[$this->currentMethod] as $key => $handler) {

            if ($handler->path == $this->currentPath) {
                $this->handlers[$this->currentMethod][$key]->middleware = $callback;
            }
        }
        
        
       app()->get(\App\Http\Kernel::class)->middleware($callback);

         

        return $this;
    }
    
    
    public function currentMiddleware($middleware)
    {
        return app()->get(\App\Http\Kernel::class)->currentMiddleware( $middleware );
        
    }
    
    public function currentMethod($method)
    {
        return app()->get(\App\Http\Kernel::class)->currentMethod( $method );
        
    }

    public function addHandler(string $path, $callback, string $method)
    {

        if (!$this->resolveMethod($method)) {
            throw new Exception("HTTP Method {$method} is not valid (POST, GET) ");
        }

        $this->handlers[$method][] = (object) [
            'path' => $path,
            'callback' => $callback,
            'method' => $method,
            'middleware' => []
        ];

        $this->currentMethod = $method;
        $this->currentPath = $path;
        
    }

    public function getCurrentMethod()
    {
        return $this->currentMethod;
    }

    public function resolveMethod(string $method)
    {

        return array_key_exists($method, $this->handlers);
    }

    /**
     * Dispatch the request to the application.
     *
     * @param  \Framework\Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dispatch(Request $request)
    {
        $this->currentRequest = $request;
    }


    public function getCurrentRoutesPrefix(Request $request)
    {
        foreach ($this->routesPrefix['groups'] as $key => $value) {
            if (preg_match("/^\/$key/", $request->getPathInfo())) {
                return $key;
            }
        }
    }

    public function getRoutesPrefix(string $uri)
    {
        foreach ($this->routesPrefix['groups'] as $key => $value) {
            if (preg_match("/^\/$key/", $uri)) {
                $prefix =  preg_replace("/^\/$key/", "", $uri);
                return $prefix ? $prefix : '/';
            }
        }
    }


    public  function resolve(Request $request)
    {



        if (!is_array($this->handlers)) {

            throw new Exception('Error in Handlers');
        }

        $argvs = [];
        $callback = null;
        $missingPath = null;
        foreach ($this->handlers as $methods_group) {

            foreach ($methods_group as $handler) {

                $UriParser = new UriParser($this->currentRequest, $handler, $this);




                if ($UriParser->is_same_request()) {

                     
                    $this->currentMiddleware((array) $handler->middleware);
                    $this->currentMethod($handler->method);

                    $argvs = $UriParser->callback_parms;
                    $callback = $handler->callback;
                    $this->missingPath = true;
                }
            }
        }



        if (is_string($callback)) {
            $callback = explode("@", rtrim($callback, "@"));
        }


        if (is_array($callback)) {

            if (empty($callback)) {
                throw new Exception('Error Missing Controller');
            }

            $instance = $callback[0];

            if (!class_exists($instance)) {
                throw new Exception('class not found');
            }

            if (count($callback) === 1) {
                $callback[1] = 'index';
            }

            $method = $callback[1];

            if (!method_exists($instance, $method)) {
                throw new Exception('Error  Method not found');
            }



            app()->get(\App\Http\Kernel::class)->currentMiddlewareFunc( [
                'type' => 'instance',
                'gateway' => $instance,
                'method' => $method,
                'argvs' => $argvs,
                'request_method' => $this->currentMethod
            ] );

            /* return RouterHelper::invokeClass(
                $instance,
                $method,
                $argvs
            ); */
            return '';
        }

        if (is_null($callback)) return;

        if (!is_callable($callback)) {
            throw new Exception('Error in Handlers');
            return;
        }

        app()->get(\App\Http\Kernel::class)->currentMiddlewareFunc( [
            'type' => 'method',
            'gateway' => $callback,
            'argvs' => $argvs,
            'request_method' => $this->currentMethod
        ] );



        return '';
    }

    public function loadRoute(Request $request)
    {
        $this->currentRoutePath = $this->routesPrefix['groups'][$this->getCurrentRoutesPrefix($request)] ?? $this->routesPrefix['default'][$this->currentRoutePath];
        try {

            require_once app()->basePath . $this->currentRoutePath;
        } catch (\Throwable $th) {

            throw $th;
        }
    }

    


    public function sendRequest(Request $request)
    {

        $this->loadRoute($request);
        

        $response = response();

        

        ob_start();

        $resolved = $this->resolve($request);

        

        $resolved = ob_get_contents() . $resolved;


        if (is_null($this->missingPath)) {

            $response->setContent(view('Web.Error.404'));
            $response->setStatusCode(404);
        } else {

            if ($this->getCurrentRoutesPrefix($request) == 'api') {
                $response->headers['Content-Type'] = 'application/json';
            }

            $response->setContent($resolved);
        }

        ob_end_clean();


        return $response;
    }
}
