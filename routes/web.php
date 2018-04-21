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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::get('/user/{id}/profile', 'UserController@show')->name('users.profile');
    Route::get('/user/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/user/{id}/update', 'UserController@update')->name('users.update');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/user/create', 'UserController@create')->name('users.create');
        Route::post('/user/store', 'UserController@store')->name('users.store');
        Route::delete('/user/{id}/delete', 'UserController@destroy')->name('users.delete');
    });


});
