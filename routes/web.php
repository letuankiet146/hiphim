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
Route::get('/message', 'MessageController@view');

Route::get('/', 'HiPhimController@ui');
Route::get('/khong-tim-thay-trang', function(){
    return view('notfound');
});
Route::get('/lien-he-quang-cao',function(){
    return view('lien-he-quang-cao');
});
Route::get('/dmca-report',function(){
    return view('dmca-report');
});
Route::get('/search/{data}','HiPhimController@liveSearch');
Route::get('/search', function(){
    return "not found";
});
Route::get('/more/{category}/{data}','HiPhimController@more');
Route::get('/phim-le/{data}','HiPhimController@phimLe');

Route::get('/detail/{link_id}', 'HiPhimController@oldDetail');
Route::get('/phim/{link_id}.html', 'HiPhimController@detail');
Route::get('/phim/{link_id}/tap-{tap}.html', 'HiPhimController@detailTap');
Route::get('/baoloi/{id}/{tap}', 'HiPhimController@baoloi');

Route::get('/admin', 'HomeController@admin');
Route::get('/themphimbo/{id}', 'HomeController@themphimbo');
Route::get('/dienvien','HomeController@dienvien');
Route::post('/themdienvien','HomeController@themdienvien');
Route::get('/reload-dien-vien','HomeController@reloadDienvien');
Route::get('/live','HomeController@live');
Route::post("/insertFilm","HomeController@insertFilm");
Route::post("/insertphimbo","HomeController@insertphimbo");

Route::post("/searchFilm","HomeController@searchFilm");
Route::get('/delete/{id}', 'HomeController@deleteFilm');

Route::post("/updateFilm","TestLinkController@updateFilm");
Route::get('/updatelink/{id}', 'TestLinkController@updateLink');
Route::get('/fixed/{id}', 'TestLinkController@fixedLink');
Route::get('/testlink', 'TestLinkController@testLink');

Route::resource('img','HomeController');

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
