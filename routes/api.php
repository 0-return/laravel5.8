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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//用户
Route::namespace('Api')->prefix('v1')->group(function(){
    Route::group(['prefix' => 'users'], function (){
        Route::post('/login','UsersController@login')->name('users.login');
        Route::post('/register','UsersController@register')->name('users.register');
        Route::post('/reset','UsersController@reset')->name('users.reset');
    });

    Route::group(['prefix' => 'users', 'middleware' => 'auth.jwt'], function(){
        Route::post('/logout','UsersController@logout')->name('users.logout');
    });

    //发送短信
    Route::group(["prefix" => "sms"], function (){
        Route::post("/sms","SmsController@send")->name("sms.send");
    });
});



