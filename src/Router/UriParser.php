<?php

namespace Core\Router;

use Core\Http\Request;

class UriParser
{

    private $uri;
    private $method;
    private $request_uri;
    private $request;
    private $requestUri;
    private $requestMethod;
    private $global_request_uri;
    public $apiRoute = false;


    private array $global_request_array = [];
    private array $local_request_array = [];

    public array $callback_parms = [];

    public function __construct(Request $request, object $uri, public Router $router)
    {

        $this->request = $request;
        $this->requestUri = $request->getPathInfo();
        $this->requestMethod = $request->getMethod();

        $this->uri = $uri->path;
        $this->method = $uri->method;
        $this->parse();
        $this->addLocalRequest();
        $this->addGlobalRequest();
    }

    public function bindParams()
    {

        $global_count = count($this->global_request_array);
        $local_count  = count($this->local_request_array);

        if ($local_count !== $global_count) return;

        for ($i = 0; $i < $global_count; $i++) {
            $item_alias = $this->local_request_array[$i];
            if ($this->is_var($item_alias)) {
                $item = $this->global_request_array[$i];
                $this->callback_parms[] = $item;
            }
        }
    }

    public function HandleRequest($path)
    {
        $uri = trim($path, "/");
        return explode("/", $uri);
    }

    public function addLocalRequest()
    {
        $this->local_request_array = $this->HandleRequest($this->get_uri());
    }

    public function addGlobalRequest()
    {
        $this->global_request_array = $this->HandleRequest($this->request_uri());
    }

    public function parse()
    {

        $this->request_uri = parse_url($this->uri);
        $this->global_request_uri = parse_url($this->requestUri);
    }

    public function request_uri()
    {

        if(!is_array($this->global_request_uri)) {
            $this->global_request_uri = ['path' => '/'];
        }

       return trim($this->router->getRoutesPrefix($this->global_request_uri['path']) ?? $this->global_request_uri['path'] , '/');

    }

    public function request_method()
    {
        return strtoupper($this->requestMethod);
    }

    public function get_uri()
    {

        return trim($this->uri , '/');
     
    }

    public function validate_var(string $str)
    {
        return preg_match("/([\pL -]+)?\s?\[?\(?:([\pL0-9\-\_]+)\)?\]?/u", $str);
    }

    public function is_var(string $str)
    {
        if ($this->validate_var($str)) return;
        return preg_match("/\{.*?\}/", $str);
    }

    public function processVariableUri()
    {

        if (count($this->global_request_array) != count($this->local_request_array)) return false;

        $match = true;
        for ($i = 0; $i < count($this->local_request_array); $i++) {
            $item_alias = strtolower($this->local_request_array[$i]);
            if (!$this->is_var($item_alias)) {
                $item = strtolower($this->global_request_array[$i]);
                if ($item != $item_alias) {
                    $match = false;
                }
            }
        }

        return $match;
    }

    public function processStringUri()
    {
      
        return ($this->get_uri() ? $this->get_uri() : '/') === ($this->request_uri() ? $this->request_uri() : '/') && $this->request_method() === $this->method;
    }

    public function is_same_request(): bool
    {

        if ($this->is_var($this->get_uri())) {
            $this->bindParams();
            return $this->processVariableUri();
        }

        return $this->processStringUri();
    }
}
