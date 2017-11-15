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

Route::get('/', 'WelcomeController@home')->name('home');

Route::get('posts', 'PostController@public')->name('posts');
Route::get('posts/{slug}', 'PostController@publicshow')->name('posts.show');

Route::prefix('admin')->group(function () {
    Route::group(['as' => 'admin.'], function () {
    Route::resource('post', 'PostController');
    Route::resource('tag', 'TagController');
    Route::resource('event', 'EventController');
    Route::resource('venue', 'VenueController');
    Route::resource('partner', 'PartnerController');
    });
});

Auth::routes();

Route::get('admin', 'HomeController@index')->name('admin');
