<?php
namespace Config;

class router
{
    public $req = [];
    public $url = "";
    public $method = "";
    private $url_found = false;

    public function resolve($url)
    {
        $this->url = $url["REQUEST_URI"];
        $this->request = $url;
        $this->method = $url["REQUEST_METHOD"];
    }

    public function get($route, $callback)
    {
        if ($this->method == "GET" && $this->url == $route && $this->url_found == false) {
            $url_found = true;
            if (is_callable($callback)) {
                call_user_func($callback);
            } else {
                $this->call($callback);
            }
        }
    }

    public function post($route, $callback)
    {
        if ($this->method == "POST" && $this->url == $route && !$this->url_found) {
            $url_found = true;
            if (is_callable($callback)) {
                call_user_func($callback);
            } else {
                $this->call($callback);
            }
        }
    }

    private function call($callback)
    {
        $controller = new $callback[0];
        $method = $callback[1];
        $controller->$method();
    }
}