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

/* FRONTEND */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* BACKEND */
Route::group(['middleware' => ['auth'],'prefix' => 'admin',], function () {    
    /* DASHBOARD */
    Route::get('/', function () {
        return view('layout.backend.dashboard.index');
    });
    Route::get('/dashboard', function () {
        return view('layout.backend.dashboard.index');
    });         
    
    /* PRODUCTS */
    Route::post('product/store', 'ProductController@store');
    Route::get('product/index', 'ProductController@index');
    Route::get('product/show/{id}', 'ProductController@show');
    Route::put('product/{id}', 'ProductController@update');
    Route::get('product/show', 'ProductController@ShowProductAll');
    
    /* USER */
    Route::get('user/details', 'UserController@get_user_details');
    Route::put('user/{id}','UserController@update');
    
    /* SHOPS */
    Route::get('/shops', 'SellerController@index');
    Route::get('/shops/new', 'SellerController@create');
    Route::post('/shops', 'SellerController@store');
    Route::get('/shops/{id}/edit', 'SellerController@edit');
    Route::get('/shops/{id}', 'SellerController@show');
    Route::put('/shops/{id}', 'SellerController@update');
    Route::delete('/shops/{id}', 'SellerController@delete');
     
});
