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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [
    'as' => 'index', 'uses' => 'ProductController@index'
]);

//Route::get('products/{un?}available', function ($un = null) {
//
//})->where('un', '(un)?');

Route::get('products/available/{input?}', [
    'as' => 'available', 'uses' => 'ProductController@available'
])->where('input', '[0-1]');

Route::get('products/having/{input?}', [
    'as' => 'having', 'uses' => 'ProductController@having'
])->where('input', '[0-9]+');

Route::resource('products','ProductController');