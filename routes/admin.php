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
            //$api->path ('users/{user}/lock', \App\Http\Controllers\Admin\UserController::class , 'lock');
            //用户管理
            //资源路由
            $api->resource ('users', \App\Http\Controllers\Admin\UserController::class, [
                'only' => [ 'index', 'show' ]
            ]);

            /*
             * 分类相关的路由
             */
          //  $api->patch ('category', \App\Http\Controllers\Admin\CategoryController::class, [ 'except' => [ 'destroy' ] ]);
           // $api->patch ('category', \App\Http\Controllers\Admin\CategoryController::class, [ 'except' => [ 'destroy' ] ]);
            /*
            * 商品相关的路由
            */
            //$api->patch ('goods/{goods}/on', \App\Http\Controllers\Admin\GoodsController::class, 'isOn');
            //$api->patch ('goods/{goods}/recommend', \App\Http\Controllers\Admin\CategoryController::class, 'isRecommend');
            $api->resource ('goods', \App\Http\Controllers\Admin\GoodsController::class, [ 'except' => [ 'destroy' ] ]);
            /*
             * 评价相关的路由
             */
            //评论列表
            $api->get ('comments', [\App\Http\Controllers\Admin\CommentController::class, 'index']);
            //评价详情
            $api->get ('comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'show']);
            //回复评价
            //$api->path ('comments/{comment}/reply', [\App\Http\Controllers\Admin\CommentController::class, 'reply']);

            /*
             * 订单相关的路由
             */
            // 订单列表
            $api->get ('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index']);
            //评价详情
            $api->get ('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show']);
            //回复评价
            //$api->path ('orders/{order}/post', [\App\Http\Controllers\Admin\OrderController::class, 'post']);

        });
    });
});
