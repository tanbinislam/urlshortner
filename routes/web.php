<?php

Auth::routes(['verify' => true]);

Route::get('/', 'LinksController@index')->name('welcome');
Route::get('/{url}', 'LinksController@goto')->name('goto');
Route::post('/url/shrink', 'LinksController@store')->name('save');
Route::get('/url/lostandfound', 'LinksController@unauthed')->name('lostandfound');

Route::get('/user/home', 'HomeController@index')->name('home')->middleware('verified');
