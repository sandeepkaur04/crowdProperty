<?php

use Illuminate\Support\Facades\Route;

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

Route::match(['get','post'],'register','App\Http\Controllers\AuthController@register');
Route::match(['get','post'],'login','App\Http\Controllers\AuthController@login')->name('login');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/user/feed', 'App\Http\Controllers\AuthController@userFeed');
    Route::get('/user/feed/{ind}', 'App\Http\Controllers\AuthController@userFeedDetail');
    Route::post('/user/upd-url', 'App\Http\Controllers\AuthController@updateUrl');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout');
});