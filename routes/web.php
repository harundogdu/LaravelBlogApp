<?php
/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
    Route::get('giris','Back\AuthController@login')->name('login');
    Route::post('giris','Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel','Back\Dashboard@index')->name('dashboard');        
    /* Article's Route */
    Route::get('makaleler/silinenler','Back\ArticleController@trashed')->name('article.trashed');
    Route::resource('makaleler', 'Back\ArticleController');    
    Route::get('switch','Back\ArticleController@switch')->name('switch');
    Route::get('articledelete/{id}','Back\ArticleController@delete')->name('article.delete');
    Route::get('articlerecovery/{id}','Back\ArticleController@recovery')->name('article.recovery');
    Route::get('harddelete/{id}','Back\ArticleController@hardDelete')->name('article.hardDelete');
    /* Category's Route */
    Route::get('kategoriler','Back\CategoryController@index')->name('kategoriler.index');
    Route::get('kategoriler/switch','Back\CategoryController@switch')->name('kategoriler.switch');
    Route::post('kategoriler/ekle', 'Back\CategoryController@create')->name('kategoriler.create');
    Route::get('kategoriler/getdata','Back\CategoryController@getData')->name('kategoriler.getdata');
    Route::post('kategoriler/update','Back\CategoryController@update')->name('kategoriler.update');
    Route::post('kategoriler/delete','Back\CategoryController@delete')->name('kategoriler.delete');
    /* Page's Route */
    Route::get('/sayfalar','Back\PageController@index')->name('sayfalar.index');
    Route::get('/sayfalar/switch','Back\PageController@switch')->name('sayfalar.switch');
    //
    Route::get('cikis','Back\AuthController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('/yazilar/sayfa','Front\Homepage@index');
Route::get('/kategori/{slug}','Front\Homepage@category')->name('category');
Route::get('/kategori/{category}/{slug}','Front\Homepage@singlePage')->name('single');
Route::get('/iletisim','Front\Homepage@contact')->name('contact');
Route::post('/iletisim','Front\Homepage@contactPost')->name('contact.post');
Route::get('/{page}','Front\Homepage@pages')->name('page');
