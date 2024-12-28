<?php
return [
    // 应用相关配置
    'app' => [
        'title' => 'Miku Sports Charity Platform',
        'description' => 'Let the Fun of Sports Be Accessible to Everyone',
        'logo' => '../images/logo.png',
        'address' => '999 Hucheng Huanlu, Pudong New Area, Shanghai, China',
        'addressLink' => 'https://www.google.com/maps/place/999+Hucheng+Huanlu,+Pudong+New+Area,+Shanghai,+China/@30.8868445,121.8956191,17z/data=!3m1!4b1!4m6!3m5!1s0x35ad768034588f11:0x89d232b593411ad6!8m2!3d30.88684!4d121.90049!16s%2Fg%2F11g4fj_p1x?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D',
        'email' => 'charity@mikufans.me',
        'phone' => '+86 150-9864-6873',
        'contactName' => 'Wentao Su',
    ],

    // 数据库相关配置
    'db' => [
        'dbHost' => 'localhost',
        'dbUser' => 'root',
        'dbPassword' => '',
        'dbName' => 'mikusportscharity',
        'dbCharset' => 'utf8mb4',
    ],

    // Pay Configuration
    'pay' => [
        'apiUrl' => 'https://epay.mikufans.me/',
        'apiPid' => '1000',
        'apiKey' => '3w5202vv0Q5k3msQ0V003563Q3w034vM',
        'notifyUrl' => '../public/pay/notify',
        'returnUrl' => '../public/result',
    ],
];
?>
