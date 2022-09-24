<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
   
    Route::group([
      'middleware' => ['auth:api']
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::post('categories', 'CategoryController@index');
        Route::post('category/create', 'CategoryController@create');
        Route::post('category/update', 'CategoryController@update');
        Route::post('category/delete', 'CategoryController@delete');
        Route::post('products', 'ProductController@index');
        Route::post('product/create', 'ProductController@create');
        Route::post('product/update', 'ProductController@update');
        Route::post('product/delete', 'ProductController@delete');
    });
});

