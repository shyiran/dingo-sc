<?php
/**
 * Notes:
 * User: shyir
 * DateTime: 2021/10/10 11:32
 */
$api = app ('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group ([ 'prefix' => 'test' ], function ($api) {
        $api->get('test01',[\app\Http\Controllers\TestController::class,'test01']);
    });
});
