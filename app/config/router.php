<?php
return [
    '/' => 'HomeController@index', // 默认主页
    '/about' => 'AboutController@about', // 关于页面
    '/dashboard' => 'DashboardController@dashboard', // 仪表盘
    '/login' => 'AuthController@login', // 登录页面
    '/register' => 'AuthController@register', // 注册页面
    '/volunteer' => 'VolunteerController@volunteer', // 志愿者页面
    '/donation' => 'DonateController@donation', // 捐赠页面
    '/api/login' => 'AuthController@apiLogin', // 登录
    '/api/register' => 'AuthController@apiRegister', // 注册
    '/api/logout' => 'AuthController@apiLogout', // 登出
    '/api/verifyLogin' => 'ApiController@verifyLogin', // 验证登录
    '/api/getEventsTimes' => 'ApiController@getEventsTimes', // 获取活动时间
    '/api/getUserDetails' => 'ApiController@getUserDetails', // 获取用户详情
    '/api/submitVolunteer' => 'ApiController@submitVolunteer', // 提交志愿者

];
?>
