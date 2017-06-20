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
Route::get('/frontend/shops/index', 'ApiController@IndexShops');
Route::get('/frontend/shops/index/{name}', 'ApiController@NameShops');
Route::get('/frontend/shops/city/{name}', 'ApiController@CittaShops');
Route::get('/frontend/shops/makers', 'ApiController@GetMakersShops');

Auth::routes();

//Route::get('/index', 'ApiController@IndexProducts');

Route::get('/login2', function() {    /*Dario - Temporaneo*/

    return view('layout/frontend/users/login2');
});

Route::get('/frontend/home', function() { /*Dario*/

    return view('layout/frontend/users/home');
});


Route::get('/frontend/products/index', 'ApiController@IndexProducts');
Route::get('/frontend/products/index/{id}', 'ApiController@GetProductsShop');
Route::get('/frontend/products/promo/{id}', 'ApiController@GetProductsShopPromo');
Route::get('/frontend/products/promo/', 'ApiController@GetProductsPromo');
Route::get('/frontend/products/disp/{id}', 'ApiController@GetProductsShopForDisp');
Route::get('/frontend/products/disp/', 'ApiController@GetProductsForDisp');
    
Route::get('/frontend/users/cart', 'ApiController@IndexProducts');



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
