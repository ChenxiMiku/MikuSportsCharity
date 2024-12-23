<?php
return [
    '/' => 'HomeController@index', // 默认主页
    '/about' => 'AboutController@about', // 关于页面
    '/dashboard' => 'DashboardController@index', // 仪表盘
    '/login' => 'AuthController@login', // 登录页面
    '/register' => 'AuthController@register', // 注册页面
    '/api/getUserAvatar' => 'ApiController@getUserAvatar', // 获取用户头像
    '/api/verifyLogin' => 'ApiController@verifyLogin', // 验证登录
];
?>
