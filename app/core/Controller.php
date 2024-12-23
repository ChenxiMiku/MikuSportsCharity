<?php

class Controller {
    /**
     * App Config
     * @var array
     */
    protected $config;

    public function __construct() {
        $this->config = include('../app/config/config.php');
    }

    /**
     * Implement the view method
     * @param string 
     * @param array 
     * @return void
     */
    public function view($view, $data = []) {
        $viewFile = "../app/views/{$view}.php";

        if (file_exists($viewFile)) {
            extract($data);

            $appConfig = $this->config['app'] ?? [];
            include $viewFile;
        } else {
            die("View {$view} not found.");
        }
    }

    /**
     * Implement the model method
     * @param string 
     * @return object 
     */
    public function model($model) {
        $modelFile = "../app/models/{$model}.php";

        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die("Model {$model} not found.");
        }
    }

    /**
     * Set and display flash messages
     * @param string 
     * @param string
     */
    public function setFlash($key, $message) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'][$key] = $message;
    }

    /**
     * Get flash messages
     * @param string
     * @return string|null
     */
    public function getFlash($key) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }
        return null;
    }

    /**
     * Redirect to a different page
     * @param string 
     * @return void
     */
    public function redirect($url) {
        header("Location: {$url}");
        exit();
    }

    /**
     * Get the app config
     * @param string 
     * @return mixed 
     */
    public function config($key) {
        return $this->config[$key] ?? null;
    }
}
