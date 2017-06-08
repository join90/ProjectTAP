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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => ['api'],'prefix' => 'v1',], function () {
    
    Route::group(['prefix' => 'mobile'], function(){

        Route::post('register', 'UserController@register');
        Route::post('login','UserController@login');    
        
        Route::group(['middleware' => 'jwt-auth', 'prefix' => 'json'], function(){
            
            Route::group(['prefix' => 'product'], function(){
                Route::post('/store', 'ProductController@store');
                Route::get('/index', 'ProductController@index');
                Route::get('/{id}', 'ProductController@show');
                Route::put('/{id}', 'ProductController@update');
            });

            Route::group(['prefix' => 'user'], function(){
                Route::get('/details', 'UserController@get_user_details');
                Route::put('/{id}','UserController@update');
            });

            Route::group(['prefix' => 'seller'], function(){
                Route::put('/update', 'SellerController@update');

            });
        });
    });   
});