<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/konfig', 'API\Front\HomeController@konfigWeb');
Route::get('/halaman/kalimat-kontak', 'API\Front\HomeController@loadKalimatKontak');
Route::get('/halaman/kalimat-tim', 'API\Front\HomeController@loadKataTim');
Route::get('/halaman/tim-kami', 'API\Front\HomeController@loadTim');
Route::get('/halaman/projek', 'API\Front\HomeController@loadProjek');
Route::get('/halaman/porto', 'API\Front\HomeController@loadPorto');

Route::get('/layanan/{id}', 'API\Front\HomeController@detilLayanan');
Route::get('/layanan', 'API\Front\HomeController@layanan');
Route::get('/tentang-kami', 'API\Front\HomeController@about');

Route::group(['middleware' => 'auth:api'], function(){

    Route::apiResources([
      '/admin/portofolio' => 'API\Admin\PortofolioController',
      '/admin/halaman' => 'API\Admin\HalamanController',
      '/admin/tim' => 'API\Admin\TimController',
    ]);

    Route::delete('/admin/layanan/{id}', 'API\Admin\LayananController@destroy');
    Route::post('/admin/layanan/{id}', 'API\Admin\LayananController@update');
    Route::post('/admin/layanan', 'API\Admin\LayananController@store');
    Route::get('/admin/layanan', 'API\Admin\LayananController@index');

    Route::get('/admin/konfigurasi', 'API\Admin\KonfigurasiController@loadKonfig');
    Route::post('/admin/konfigurasi', 'API\Admin\KonfigurasiController@postKonfig');
});
