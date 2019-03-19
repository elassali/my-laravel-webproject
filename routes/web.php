<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Worker;
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

Route::get('/index', function () {
    return view('website.genre');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
////////////////////////////////////////////////////////////////////////////


Route::group(['middleware'=>'Worker'],function()
{
    Route::resource('/admin/movie','Movie_Controller');
    Route::resource('/admin/serie','SerieController');
    Route::resource('/admin/season','SeasonController');
    Route::resource('/admin/episode','EpisodeController');
    Route::get('/findepisode','EpisodeController@findepisode');
    Route::get('logout', ['as'=>'logout','uses'=>'Auth\LoginController@logout']);

});




 
////////////////////////////////////////////////////////////////////////
Route::group(['middleware'=>'Admin'],function()
{
Route::get('/admin/result',['as'=>'result','uses'=>'search@result']);
Route::resource('/user','UserController');
Route::resource('/category','CategoryController');
Route::resource('/country','CountryController');
Route::resource('/advirtisement','Advirtisement');
Route::get('/messages',['as'=>'message','uses'=>'ContactController@index']); 
Route::get('/messages/emails',['as'=>'emails','uses'=>'ContactController@emails']);
Route::delete('/message/delete/{id}',['as'=>'destroy','uses'=>'ContactController@destroy']);
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('/','indexmoviepage');
Route::get('/watch/{id}',['as'=>'watch','uses'=>'indexmoviepage@watch']);
Route::get('/tv-serie',['as'=>'tv-serie','uses'=>'indexmoviepage@tvseries']);
Route::get('watchserie/{idserie}/{idseason}/{idepisode}',['as'=>'watchserie','uses'=>'indexmoviepage@watchserie']);
Route::get('/loadepisode','indexmoviepage@loadepisode');
Route::get('/season/{serie}/{season}',['as'=>'season','uses'=>'indexmoviepage@seasons']);
Route::Post('/send','indexmoviepage@message');
Route::get('/contact',['as'=>'contact','uses'=>'indexmoviepage@contact']);
Route::get('/genre/{genre}',['as'=>'genre','uses'=>'indexmoviepage@genre']);
Route::get('/country/{country}',['as'=>'country','uses'=>'indexmoviepage@country']);
Route::get('/search',['as'=>'search','uses'=>'indexmoviepage@search']);
Route::get('/privacy',['as'=>'privacy','uses'=>'indexmoviepage@privacy']);


//auto complete route

Route::post('/autocomplete','indexmoviepage@fetch')->name('autocomplete.fetch');



