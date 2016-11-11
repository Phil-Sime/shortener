<?php

Route::get('/', 'UrlController@index');
Route::get('/recent', 'UrlController@recentUrls');
Route::get('/top', 'UrlController@topUrls');
Route::get('/{id}', 'UrlController@redirect');
Route::post('/create', 'UrlController@store');