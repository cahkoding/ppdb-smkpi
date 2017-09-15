<?php

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/list_peserta', 'PublicController@list_peserta');\
Route::get('/profile', 'PublicController@profile');
Route::get('/info_ppdb', 'PublicController@info_ppdb');
Route::get('/info_ppdb/{id}', 'PublicController@info_detail');

Route::group(['middleware'=>'admin'], function(){
    Route::get('/admin', 'adminController@index');
    Route::get('/peserta', 'adminController@peserta');
    Route::get('/cetakform/{id}', 'AdminController@cetakForm');
    Route::get('/hapus/{id}', 'AdminController@hapus');
    Route::get('/edit/{id}', 'AdminController@edit');
    Route::post('/edit/{id}', 'AdminController@update');

    Route::get('/info', 'InfoController@index');
    Route::post('/info', 'InfoController@store');
    Route::get('/info/create', 'InfoController@create');
    Route::get('/info/{id}', 'InfoController@show');
    Route::delete('/info/{id}', 'InfoController@destroy');
    Route::put('/info/{id}', 'InfoController@update');
    Route::get('/laporan', 'LaporanController@index');
    Route::get('/pesan_admin', 'AdminController@pesan');
    Route::get('/pesan_admin/{id}', 'AdminController@pesan_detail');
    Route::post('/pesan_admin/{id}', 'AdminController@reply');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/biodata_saya', 'UserController@biodata');
    // Route::post('/biodata_saya', 'UserController@simpan')->name('simpanData');
    Route::post('/biodata_saya', 'UserController@simpan');
    Route::post('/upload', 'UserController@upload');
    // Route::get('/download/{file}', 'UserController@download');
    Route::get('/cetakform', 'UserController@cetakForm');

    Route::get('/pesan', 'PesanController@index');
    Route::post('/pesan', 'PesanController@send');
    Route::get('/pesan/{id}', 'PesanController@detail');
    Route::post('/pesan/{id}', 'PesanController@reply');
    Route::get('get-updates','TelegramController@getUpdates');
    Route::get('send','TelegramController@getSendMessage');
    Route::post('send','TelegramController@postSendMessage');
});
