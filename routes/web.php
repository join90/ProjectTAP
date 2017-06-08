<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {

	return view('login');
});

/*Route::get('/home', function() {

    return view('home');
});*/

Route::post('home', array('uses' => 'Auth\LoginController@login'));


Route::group(['middleware' => ['web'],'prefix' => 'api',], function () {
    Route::post('register', 'UserController@register');
    Route::post('login','UserController@login');    
    
    Route::group(['prefix' => 'v1'], function(){
        
        Route::get('/user/details', 'UserController@get_user_details');
        Route::put('/{id}','UserController@update');
    });

    Route::group(['prefix' => 'v1'], function(){
        
        Route::post('/product/store', 'ProductController@store');
        Route::get('/product/index', 'ProductController@index');
        Route::get('/product/{id}', 'ProductController@show');
        Route::put('/product/{id}', 'ProductController@update');
    });   
});

