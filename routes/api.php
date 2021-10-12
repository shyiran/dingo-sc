<?php
//use App\Http\Controllers\TestController;
//use App\Http\Controllers\v1\UserController as v1_userController;
//use App\Http\Controllers\v2\UserController as v2_userController;
/*
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;*/

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//系统默认
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
//$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', function ($api) {
    //$api->get('index',[TestController::class,'index']);

    //$api->get('test',[\app\Http\Controllers\TestController::class,'test']);
    //$api->get('users/{id}', [TestController::class,'show']);
    //$api->get('v1users/{id}', [v1_userController::class,'show']);
    //$api->get('v2users/{id}', [v2_userController::class,'show']);
    //路由命名
    //$api->get('name', ['as' => 'test.name', 'uses' =>'App\Http\Controllers\TestController@name']);
    //需要登录的路由
    //$api->group(['middleware'=>'api.auth'],function ($api){
    //    $api->get('users',[\App\Http\Controllers\TestController::class,'users']);
    //});

    //登录
   // $api->post('login',[TestController::class,'login']);
   // $api->post('logout', [TestController::class,'logout']);

   // $api->post('refresh', [TestController::class,'refresh']);
   // $api->post('me', [TestController::class,'me']);



    //$api->post('login', 'ApiController@login');
    //$api->post('register', 'ApiController@register');

   /* $api->group(['middleware' => 'auth.jwt'], function ($api) {
        $api->get('logout', 'ApiController@logout');

        $api->get('user', 'ApiController@getAuthUser');

        $api->get('products', 'ProductController@index');
        $api->get('products/{id}', 'ProductController@show');
        $api->post('products', 'ProductController@store');
        $api->put('products/{id}', 'ProductController@update');
        $api->delete('products/{id}', 'ProductController@destroy');
    });*/

//});
//$api->version('v2', function ($api) {
 //   $api->get('tests',[\app\Http\Controllers\TestController::class,'tests']);
 //   $api->get('name', ['as' => 'test.name', 'uses' =>'App\Http\Controllers\TestController@name']);
//});


