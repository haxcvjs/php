<?php


namespace Core\Http;


class Request
{

    protected $post_data  = [];
    protected $query_data = [];
    protected $headers = [];

    public function __construct()
    {



        foreach ($_GET as $key => $value) {
            $this->query_data[$key] = $value;
        }

        $jsn = (json_decode(file_get_contents('php://input')));

        $payload = $_POST ? $_POST : json_decode(file_get_contents('php://input'));

        if (is_object($payload) || is_array($payload)) {

            foreach ($payload as $key => $value) {
                $this->post_data[$key] = $value;
            }
        }
    }

    public function getPathInfo()
    {

        return rtrim(preg_replace("/\?.*/", "", $_SERVER['REQUEST_URI']), '/');
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function query($name)
    {
        if (array_key_exists($name, $this->query_data)) {
            return $this->query_data[$name];
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->post_data)) {
            return $this->post_data[$name];
        }
    }
}
