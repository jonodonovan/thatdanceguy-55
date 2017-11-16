<?php

Route::get('/', 'WelcomeController@home')->name('home');

Route::get('posts', 'PostController@public')->name('posts');
Route::get('posts/{slug}', 'PostController@publicshow')->name('posts.show');

Route::get('events', 'EventController@public')->name('events');
Route::get('events/{slug}', 'EventController@publicshow')->name('events.show');

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
