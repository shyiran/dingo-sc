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
            /*
             * 用户管理
             */
             //禁用（启用）用户
            $api->patch ('users/{user}/lock', [\App\Http\Controllers\Admin\UserController::class , 'lock']);
            $api->resource ('users', \App\Http\Controllers\Admin\UserController::class, [
                'only' => [ 'index', 'show' ]
            ]);
            /*
              分类相关
            */
            $api->patch ('category/{category}/status', [\App\Http\Controllers\Admin\CategoryController::class , 'status']);
            $api->resource ('category', \App\Http\Controllers\Admin\CategoryController::class, [ 'except' => [ 'destroy' ] ]);
            /*
             * 商品相关的路由
             */
            //是否上架
            $api->patch ('goods/{good}/on', [\App\Http\Controllers\Admin\GoodsController::class, 'isOn']);
            //是否推荐
            $api->patch ('goods/{good}/recommend', [\App\Http\Controllers\Admin\GoodsController::class, 'isRecommend']);
            $api->resource ('goods', \App\Http\Controllers\Admin\GoodsController::class,
                [ 'except' => [ 'destroy' ]
            ]);








            //
            //资源路由



          //  $api->patch ('category', \App\Http\Controllers\Admin\CategoryController::class, [ 'except' => [ 'destroy' ] ]);
           //

            //
            //

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
            /*
             * 商品轮播图路由
             */
       //     $api->patch ('slides/{slide}/seq', \App\Http\Controllers\Admin\SlideController::class, 'isOn');
            //$api->patch ('goods/{goods}/recommend', \App\Http\Controllers\Admin\CategoryController::class, 'isRecommend');
        //    $api->resource ('slides', \App\Http\Controllers\Admin\SlideController::class);
        });
    });
});
