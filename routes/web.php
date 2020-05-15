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
    return view('index');
});

Auth::routes();

// User routes
Route::middleware('auth', 'throttle:60,1')->group(function () {
    // Logged In user can access
    Route::get('/home', 'UserController@index')->name('home');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication for admin
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('login');

    // Logged In admin can access
    Route::middleware('auth:admin', 'throttle:60,1')->group(function () {
        Route::get('/home', 'Admin\HomeController@index')->name('home');
        Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('logout');

        // Category
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/add', 'Admin\CategoryController@add')->name('add');
            Route::post('/store', 'Admin\CategoryController@store')->name('store');
            Route::get('/{category}/edit', 'Admin\CategoryController@edit')->name('edit');
            Route::put('/{category}/update', 'Admin\CategoryController@update')->name('update');
            Route::delete('/{category}/delete', 'Admin\CategoryController@delete')->name('delete');
        });
    });
});
