<?php

class Controller {
    protected $config;

    public function __construct() {
        $this->config = include('../app/config/config.php');
    }

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

    public function model($model) {
        $modelFile = "../app/models/{$model}.php";

        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die("Model {$model} not found.");
        }
    }

    public function setFlash($key, $message) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'][$key] = $message;
    }

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

    public function redirect($url) {
        header("Location: {$url}");
        exit();
    }

    public function config($key) {
        return $this->config[$key] ?? null;
    }
}
