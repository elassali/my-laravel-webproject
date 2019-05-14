<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Worker;
use App\Watchepisode;
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
Route::get('/testfull', function()
{



});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
////////////////////////////////////////////////////////////////////////////


Route::group(['middleware'=>'Worker'],function()
{
    Route::get('/admin/movie/createbyurl',['as' => 'movie.createbyurl' , 'uses' => 'Movie_Controller@createbyurl']);
    Route::Post('/admin/movie/storebyurl',['as' => 'movie.storebyurl' , 'uses' => 'Movie_Controller@storebyurl']);
    //==============================================================>
    Route::get('/admin/episode/multiepisodes',['as'=>'episode.multiepisodes','uses'=>'EpisodeController@createmultiepisodes']);
    Route::Post('/admin/episode/multistore' ,['as'=>'multistore' , 'uses' => 'EpisodeController@multistore']);
    //==============================================================>
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
Route::resource('/admin/remote','Remot');
Route::resource('/admin/apiaccount','api_controller');
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/watchserie/{idepisode}',['as'=>'watchserie','uses'=>'indexmoviepage@watchserie']);
Route::get('/watch/{id}',['as'=>'watch','uses'=>'indexmoviepage@watch']);
Route::get('/tv-serie',['as'=>'tv-serie','uses'=>'indexmoviepage@tvseries']);
Route::get('/loadepisode','indexmoviepage@loadepisode');
Route::get('/season/{season}',['as'=>'season','uses'=>'indexmoviepage@seasons']);
Route::get('/contact',['as'=>'contact','uses'=>'indexmoviepage@contact']);
Route::get('/genre/{genre}',['as'=>'genre','uses'=>'indexmoviepage@genre']);
Route::get('/country/{country}',['as'=>'country','uses'=>'indexmoviepage@country']);
Route::get('/search',['as'=>'search','uses'=>'indexmoviepage@search']);
Route::get('/privacy',['as'=>'privacy','uses'=>'indexmoviepage@privacy']);
//auto complete route
Route::get('/autocomplete','indexmoviepage@fetch')->name('autocomplete.fetch');
Route::Post('/send','indexmoviepage@message');
Route::resource('/','indexmoviepage');