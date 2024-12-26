<?php
class App {
    protected $controller = 'HomeController'; // 默认控制器
    protected $method = 'index';             // 默认方法
    protected $params = [];                  // URL 参数
    protected $router = [];                  // 路由配置

    public function __construct() {
        $this->router = include('../app/config/router.php'); // 加载路由配置

        try {
            $url = $this->parseUrl(); // 解析 URL
            $this->dispatch($url);    // 分发请求
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    /**
     * 解析 URL
     * @return array
     */
    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    /**
     * 分发请求
     * 根据路由配置加载控制器和方法
     * @param array $url
     * @return void
     * @throws Exception
     */
    private function dispatch($url) {
        $path = '/' . implode('/', $url); // 构造路径
        //error_log("Request path: {$path}");

        if (isset($this->router[$path])) {
            [$this->controller, $this->method] = explode('@', $this->router[$path]);
        } else {
            throw new Exception("Route '{$path}' not defined.");
        }

        $this->loadController(); // 加载控制器
        $this->callMethod();     // 调用方法
    }

    /**
     * 加载控制器
     * @return void
     * @throws Exception
     */
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

    /**
     * 调用控制器的方法
     * @return void
     * @throws Exception
     */
    private function callMethod() {
        if (!method_exists($this->controller, $this->method)) {
            throw new Exception("Method '{$this->method}' not found in controller '{$this->controller}'.");
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * 错误处理
     * @param string $error
     * @return void
     */
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
