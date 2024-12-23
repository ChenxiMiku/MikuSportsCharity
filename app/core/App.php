<?php
class App {
    protected $controller = 'HomeController'; 
    protected $method = 'index';             
    protected $params = [];                  

    public function __construct() {
        try {
            $router = include('../app/config/router.php');
            $url = $this->parseUrl();

            if (!empty($url) && isset($router[$url[0]])) {
                [$this->controller, $this->method] = explode('@', $router[$url[0]]);
                unset($url[0]);
            } elseif (!empty($url[0])) {
                $controllerName = ucfirst($url[0]) . 'Controller'; 
                $controllerPath = "../app/controllers/{$controllerName}.php";
                
                if (file_exists($controllerPath)) {
                    $this->controller = $controllerName;
                    unset($url[0]);
                } else {
                    throw new Exception("Controller '{$controllerName}' not found.");
                }
            }

            require_once "../app/controllers/{$this->controller}.php";
            if (!class_exists($this->controller)) {
                throw new Exception("Class '{$this->controller}' not found.");
            }
            $this->controller = new $this->controller;

            if (isset($url[0]) && method_exists($this->controller, $url[0])) {
                $this->method = $url[0];
                unset($url[0]);
            } elseif (isset($url[0])) {
                throw new Exception("Method '{$url[0]}' not found in controller '{$this->controller}'.");
            }

            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);            
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    /**
     * Parse the URL
     * @return array
     */
    private function parseUrl() {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return array_map(function($part) {
                return '/' . $part;
            }, $url);
        }
        return [];
    }

    /**
     * Error handling
     * @param string 
     * @return void
     */
    private function handleError($error) {
        error_log($error);
        
        http_response_code(404);
        
        echo "<h1>Oops! Something went wrong.</h1>";
        echo "<p>Error details: {$error}</p>";
        die();
    }
}
?>