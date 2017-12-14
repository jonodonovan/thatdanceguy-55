<?php

Route::get('/', 'WelcomeController@home')->name('home');
Route::view('hire-me', 'public.pages.contact');
Route::post('hire-me/submit', 'ContactController@store')->name('contact.submit');

Route::get('posts', 'PostController@public')->name('posts');
Route::get('posts/{slug}', 'PostController@publicshow')->name('posts.show');

Route::get('events', 'EventController@public')->name('events');
Route::get('events/{slug}', 'EventController@publicshow')->name('events.show');

Route::get('tags', 'TagController@public')->name('tags');
Route::get('tags/{slug}', 'TagController@publicshow')->name('tags.show');

Route::get('venues', 'VenueController@public')->name('venues');
Route::get('venues/{slug}', 'VenueController@publicshow')->name('venues.show');

Route::get('partners', 'PartnerController@public')->name('partners');
Route::get('partners/{slug}', 'PartnerController@publicshow')->name('partners.show');

Route::prefix('admin')->group(function () {
    Route::group(['as' => 'admin.', 'middleware' => ['admin']], function () {
        Route::resource('post', 'PostController');
        Route::resource('tag', 'TagController');
        Route::resource('event', 'EventController');
        Route::resource('venue', 'VenueController');
        Route::resource('partner', 'PartnerController');
        Route::get('contact', 'ContactController@index')->name('contact.index');
    });
});

Auth::routes();

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin', 'HomeController@index')->name('admin');
});
