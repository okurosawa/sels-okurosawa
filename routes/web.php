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

    // User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/list', 'UserController@list')->name('list');
        Route::get('/follow/{user}', 'UserController@follow')->name('follow');
        Route::get('/unfollow/{user}', 'UserController@unfollow')->name('unfollow');
        Route::get('/{user}/profile', 'UserController@profile')->name('profile');
        Route::get('/{user}/follower', 'UserController@follower')->name('follower');
        Route::get('/{user}/following', 'UserController@following')->name('following');
    });

    // Category
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('list', 'CategoryController@list')->name('list');
    });
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

        // Word
        Route::prefix('word')->name('word.')->group(function () {
            Route::get('/list/category/{category}', 'Admin\WordController@list')->name('list');
            Route::get('/add/category/{category}', 'Admin\WordController@add')->name('add');
            Route::post('/store/category/{category}', 'Admin\WordController@store')->name('store');
            Route::get('/{word}/edit', 'Admin\WordController@edit')->name('edit');
            Route::put('/{word}/update', 'Admin\WordController@update')->name('update');
            Route::delete('/{word}/delete', 'Admin\WordController@delete')->name('delete');
        });

        // choice
        Route::prefix('choice')->name('choice.')->group(function () {
            Route::get('/list/word/{word}', 'Admin\ChoiceController@list')->name('list');
            Route::get('/add/word/{word}', 'Admin\ChoiceController@add')->name('add');
            Route::post('/store/word/{word}', 'Admin\ChoiceController@store')->name('store');
            Route::get('/{choice}/edit', 'Admin\ChoiceController@edit')->name('edit');
            Route::put('/{choice}/update', 'Admin\ChoiceController@update')->name('update');
            Route::delete('/{choice}/delete', 'Admin\ChoiceController@delete')->name('delete');
        });
    });
});
