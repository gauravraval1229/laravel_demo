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

Auth::routes();
Route::get('/sign-up','Auth\RegisterController@showRegistrationForm');
Route::any('/','Auth\LoginController@showLoginForm');
/*Route::get('/dashboard', 'AdminController@index');*/
Route::post('/registration-submit','Auth\RegisterController@register');

// Admin
Route::get('/edit-user/{id}','AdminController@editUser');
Route::post('/update-user','AdminController@updateUser');
Route::get('/delete-user/{id}','AdminController@deleteUser');

// User
Route::get('/dashboard','UserController@index');
Route::get('/edit-profile','UserController@editProfile');
Route::post('/update-profile','UserController@updateProfile');