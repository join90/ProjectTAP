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

Route::get('/login2', function() {    /*Dario - Temporaneo*/

    return view('layout/frontend/users/login2');
});

Route::get('/frontend/home', function() { /*Dario*/

    return view('layout/frontend/users/home');
});


Route::group(['prefix' => '/frontend/products'], function(){
    Route::get('/index', 'ApiController@IndexProducts');
    Route::get('/index/{id}', 'ApiController@GetProductsShop');
    Route::get('/promo/{id}', 'ApiController@GetProductsShopPromo');
    Route::get('/promo/', 'ApiController@GetProductsPromo');
    Route::get('/disp/{id}', 'ApiController@GetProductsShopForDisp');
    Route::get('/disp/', 'ApiController@GetProductsForDisp');

});

Route::group(['prefix' => '/frontend/shops'], function(){
    Route::get('/index', 'ApiController@IndexShops');
    Route::get('/index/{name}', 'ApiController@NameShops');
    Route::get('/city/{name}', 'ApiController@CittaShops');
});

Route::post('home', array('uses' => 'Auth\LoginController@login'));

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
    Route::get('/products', 'ProductController@index');
    Route::get('/products/new', 'ProductController@create');
    Route::post('/products', 'ProductController@store');
    Route::get('/products/{id}/edit', 'ProductController@edit');
    Route::get('/products/{id}', 'ProductController@show');
    Route::put('/products/{id}', 'ProductController@update');
    Route::delete('/products/{id}', 'ProductController@delete');
    
    /* SHOPS */
    Route::get('/shops', 'SellerController@index');
    Route::get('/shops/new', 'SellerController@create');
    Route::post('/shops', 'SellerController@store');
    Route::get('/shops/{id}/edit', 'SellerController@edit');
    Route::get('/shops/{id}', 'SellerController@show');
    Route::put('/shops/{id}', 'SellerController@update');
    Route::delete('/shops/{id}', 'SellerController@delete');
     
});
