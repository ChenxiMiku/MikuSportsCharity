<?php
class App {
    protected $controller = 'HomeController'; 
    protected $method = 'index';            
    protected $params = [];             
    protected $router = [];              

    public function __construct() {
        $this->router = include('../app/config/router.php');

        try {
            $url = $this->parseUrl(); 
            $this->dispatch($url); 
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    private function dispatch($url) {
        $path = '/' . implode('/', $url); 

        if (isset($this->router[$path])) {
            [$this->controller, $this->method] = explode('@', $this->router[$path]);
        } else {
            throw new Exception("Route '{$path}' not defined.");
        }

        $this->loadController(); 
        $this->callMethod(); 
    }

    private function loadController() {
        $controllerPath = "../app/controllers/{$this->controller}.php";

        if (!file_exists($controllerPath)) {
            throw new Exception("Controller '{$this->controller}' not found.");
        }

        require_once $controllerPath;

        if (!class_exists($this->controller)) {
            throw new Exception("Class '{$this->controller}' not found.");
        }

        $this->controller = new $this->controller;
    }

    private function callMethod() {
        if (!method_exists($this->controller, $this->method)) {
            throw new Exception("Method '{$this->method}' not found in controller '{$this->controller}'.");
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function handleError($error) {
        error_log($error);
        error_log("Error: " . $error);
        error_log("URL: " . $_SERVER['REQUEST_URI']);
        error_log("Method: " . $_SERVER['REQUEST_METHOD']);

        http_response_code(404);
        echo "<h1>Oops! Something went wrong.</h1>";
        echo "<p>Error details: {$error}</p>";
        die();
    }
}
