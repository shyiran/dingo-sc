<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 22:44
 */
$api = app ('Dingo\Api\Routing\Router');
$api->version ('v1', [ 'middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1 ], function ($api) {
    $api->group ([ 'prefix' => 'auth' ], function ($api) {
        //注册
        $api->post ('register', [ \App\Http\Controllers\Auth\RegisterController::class, 'register' ]);
        //登录
        $api->post ('login', [ \App\Http\Controllers\Auth\LoginController::class, 'login' ]);
        //需要登录验证
        $api->group ([ 'middleware' => 'api.auth' ], function ($api) {
            //退出登录
            $api->post ('logout', [ \App\Http\Controllers\Auth\LoginController::class, 'logout' ]);
            //刷新TOKEN
            $api->post ('refresh', [ \App\Http\Controllers\Auth\LoginController::class, 'refresh' ]);
        });
    });

});
