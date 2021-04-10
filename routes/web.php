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

Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('/yazilar/sayfa','Front\Homepage@index');
Route::get('/kategori/{slug}','Front\Homepage@category')->name('category');
Route::get('/kategori/{category}/{slug}','Front\Homepage@singlePage')->name('single');
Route::get('/iletisim','Front\Homepage@contact')->name('contact');
Route::post('/iletisim','Front\Homepage@contactPost')->name('contact.post');
Route::get('/{page}','Front\Homepage@pages')->name('page');
