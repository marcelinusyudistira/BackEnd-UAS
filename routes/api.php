<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('verify', 'Api\AuthController@verify');

Route::group(['middleware' => 'auth:api'], function (){
    Route::post('logout', 'Api\AuthController@logout');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('category', 'Api\CategoryController@index');
    Route::get('category/{id}', 'Api\CategoryController@show');
    Route::post('category', 'Api\CategoryController@store');
    Route::put('category/{id}', 'Api\CategoryController@update');
    Route::delete('category/{id}', 'Api\CategoryController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('produk', 'Api\ProdukController@index');
    Route::get('produk/{id}', 'Api\ProdukController@show');
    Route::post('produk', 'Api\ProdukController@store');
    Route::put('produk/{id}', 'Api\ProdukController@update');
    Route::delete('produk/{id}', 'Api\ProdukController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('brand', 'Api\BrandController@index');
    Route::get('brand/{id}', 'Api\BrandController@show');
    Route::post('brand', 'Api\BrandController@store');
    Route::put('brand/{id}', 'Api\BrandController@update');
    Route::delete('brand/{id}', 'Api\BrandController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('user', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@show');
    Route::post('user', 'Api\UserController@store');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('order', 'Api\OrderController@index');
    Route::get('order/{id}', 'Api\OrderController@show');
    Route::post('order', 'Api\OrderController@store');
    Route::put('order/{id}', 'Api\OrderController@update');
    Route::delete('order/{id}', 'Api\OrderController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('orderdetail', 'Api\OrderDetailController@index');
    Route::get('orderdetail/{id}', 'Api\OrderDetailController@show');
    Route::post('orderdetail', 'Api\OrderDetailController@store');
    Route::put('orderdetail/{id}', 'Api\OrderDetailController@update');
    Route::delete('orderdetail/{id}', 'Api\OrderDetailController@destroy');
});