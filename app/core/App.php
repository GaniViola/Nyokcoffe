<?php

class App {

    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Cek apakah controller file ada?
        if (empty($url)){
            $this->controller;
            $this->method;
        }else {
            if (file_exists('../app/controllers/'.$url[0].'.php')){
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        // Panggil file Home yang ada pada folder controller
        require_once '../app/controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            // Pengecekan apakah method ada dan bersifat public
            if (method_exists($this->controller, $url[1]) && is_callable([$this->controller, $url[1]])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                // Jika method tidak public, redirect ke halaman error atau set method default
                $this->method = 'index'; // Atau arahkan ke method lain sesuai kebutuhan
            }
        }

        if (!empty($url)){
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    public function parseURL(){
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
