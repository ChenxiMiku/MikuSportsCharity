<?php
error_reporting(E_ALL);

ini_set('display_errors', 0); 
ini_set('log_errors', 1); 
ini_set('error_log', __DIR__ . '/../logs/error_log.log');

require_once '../app/config/Config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

$app = new App();
?>