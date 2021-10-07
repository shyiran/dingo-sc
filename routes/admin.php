<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/6 22:44
 */
$api = app ('Dingo\Api\Routing\Router');
//参数
$params = [
    'middleware' => [
        'api.throttle',
        'bindings',
        'serializer:array',//
    ],
    'limit' => 60,
    'expires' => 1
];
$api->version ('v1', $params, function ($api) {
    $api->group ([ 'prefix' => 'admin' ], function ($api) {
        //需要登录的
        $api->group ([ 'middleware' => 'api.auth' ], function ($api) {
            //禁用（启用）用户
            //$api->path ('users/{user}/lock', [\App\Http\Controllers\Admin\UserController::class, 'lock' ]);
            //用户管理
            //资源路由
            $api->resource ('users', \App\Http\Controllers\Admin\UserController::class, [
                'only' => [ 'index', 'show' ]
            ]);

            /*
             * 分类相关的路由
             */
            $api->resource ('category', \App\Http\Controllers\Admin\CategoryController::class, ['except'=>['destroy']]);
        });
    });
});
