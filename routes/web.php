<?php
/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('admin/panel','Back\Dashboard@index')->name('admin.dashboard');
Route::get('admin/login','Back\Auth@login')->name('admin.login');

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('/yazilar/sayfa','Front\Homepage@index');
Route::get('/kategori/{slug}','Front\Homepage@category')->name('category');
Route::get('/kategori/{category}/{slug}','Front\Homepage@singlePage')->name('single');
Route::get('/iletisim','Front\Homepage@contact')->name('contact');
Route::post('/iletisim','Front\Homepage@contactPost')->name('contact.post');
Route::get('/{page}','Front\Homepage@pages')->name('page');
