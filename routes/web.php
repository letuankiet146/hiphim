<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/create', 'MessageController@create');
Route::get('/message/{id}', 'MessageController@view');

Route::get('/', 'HiPhimController@ui');
Route::get('/detail', 'HiPhimController@detail');
Route::get('/xemphim', 'HiPhimController@xemphim');

Route::get('/admin', 'HomeController@admin');
Route::get('/live','HomeController@live');
Route::get('/testlink', 'TestLinkController@testlink');
Route::post("/insertFilm","HomeController@insertFilm");
Route::post("/updateFilm","HomeController@updateFilm");
Route::post("/searchFilm","HomeController@searchFilm");
Route::get('/update/{id}', 'TestLinkController@updateURL');
Route::get('/delete/{id}', 'HomeController@deleteFilm');
Route::resource('img','HomeController');

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
