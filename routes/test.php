<?php
use App\Http\Controllers\TestController;
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/10 11:32
 */
$api = app ('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('index',[TestController::class,'index']);
    $api->get('name', ['as' => 'test.name', 'uses' => '\app\Http\Controllers\TestController@name']);
    $api->get('users',[TestController::class,'users']);
});
