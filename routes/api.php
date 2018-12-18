<?php

use Illuminate\Http\Request;

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
//Route::group(['namespace' => 'Api'],function($route){
//    $route->get('/banner',function (){
//        return "111";
//    });
//});
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->get('/index/banner','CommonApiController@banner');
    $api->get('/index/advantage','CommonApiController@advantage');
    $api->get('/index/complete_machine_category','CommonApiController@complete_machine_category');
    $api->get('/index/news','CommonApiController@index_news');
    $api->get('/news','CommonApiController@news');
    $api->get('/product/{frameworks}/products','CommonApiController@products');
    $api->get('/product/complete_machine_categorys','CommonApiController@complete_machine_categorys');
    $api->get('/product/{complete_machine}/complete_machine_info','CommonApiController@complete_machine_show');
    $api->get('/product/completeMachine/{complete_machine}/collect', 'CommonApiController@collect');
    $api->get('/product/completeMachine/{complete_machine}/intention_to_order', 'CommonApiController@intention_to_order');
});

