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

    // User routes
    Route::get('/users/{id}/profile', 'UserController@show')->name('users.profile');
    Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{id}/update', 'UserController@update')->name('users.update');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users/store', 'UserController@store')->name('users.store');
        Route::delete('/users/{id}/delete', 'UserController@destroy')->name('users.delete');
    });

    // Event routes
    Route::group(['middleware' => ['role:admin|manager']], function () {
        Route::get('/events', 'EventController@index')->name('events.index');
        Route::get('/events/{id}/show', 'EventController@show')->name('events.show');
        Route::get('/events/create', 'EventController@create')->name('events.create');
        Route::post('/events/store', 'EventController@store')->name('events.store');
        Route::get('/events/{id}/edit', 'EventController@edit')->name('events.edit');
        Route::put('/events/{id}/update', 'EventController@update')->name('events.update');
        Route::delete('/events/{id}/delete', 'EventController@destroy')->name('events.delete');
        Route::get('/events/trashed', 'EventController@trashed')->name('events.trashed');
        Route::put('/events/{id}/restore', 'EventController@restore')->name('events.restore');
        Route::delete('/events/{id}/delete-forever', 'EventController@forceDestroy')->name('events.delete-forever');
        Route::post('/events/{id}/remove-image', 'EventController@removeImage')->name('events.remove-image');
    });

});
