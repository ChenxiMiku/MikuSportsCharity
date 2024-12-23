<?php
// 启用错误报告
error_reporting(E_ALL);

// 设置错误显示和日志记录
ini_set('display_errors', 0); // 关闭错误在页面上的显示
ini_set('log_errors', 1);     // 启用错误日志记录
ini_set('error_log', __DIR__ . '/../logs/error_log.log'); // 设置错误日志路径

require_once '../app/config/Config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

$app = new App();
?>