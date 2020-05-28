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
Route::post('/registration-submit','Auth\RegisterController@register');

// Login
Route::any('/','Auth\LoginController@showLoginForm');

// Admin
Route::get('/admin-dashboard', 'AdminController@index');
Route::get('/edit-user/{id}','AdminController@editUser');
Route::post('/update-user','AdminController@updateUser');
Route::get('/delete-user/{id}','AdminController@deleteUser');

// User
Route::get('/dashboard','UserController@index');
Route::get('/edit-profile','UserController@editProfile');
Route::post('/update-profile','UserController@updateProfile');

Route::fallback(function () {
    return "Sorry page not found.";
});