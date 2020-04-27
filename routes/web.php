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

/*Route::get('/', function () {
    return view('registration');
});
*/
Auth::routes();
Route::get('/sign-up','Auth\RegisterController@showRegistrationForm');
Route::get('/','Auth\LoginController@showLoginForm');

Route::post('/registration-submit','Auth\RegisterController@register');