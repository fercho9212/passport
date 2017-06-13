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
Route::post('login','API\UserController@login');
Route::get('details','API\UserController@details');
Route::post('register','API\UserController@register');
Route::get('login',function(){
  echo 'wer ';
});


Route::post('login/driver','API\DriverController@login');
Route::post('register/driver','API\DriverController@register');
Route::get('register/driver',function(){
  echo 'welcome Driver ';
});
Route::get('/home',function(){
  echo 'welcome home';
});



Route::get('hola',function(){
  echo 'dasdasdddddd ';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
