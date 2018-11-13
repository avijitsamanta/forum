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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{provider}/auth', 'SocialsController@auth')->name('social.auth');

Route::get('{provider}/redirect', 'SocialsController@auth_callback')->name('social.callback');

Route::get('/channel/show/{slug}', 'ChannelsController@show')->name('channel');

Route::get('/forum','ForumsController@index')->name('forum');
	
Route::get('discussions/show/{slug}','DiscussionsController@show')->name('discussion');

Route::resource('channels','ChannelsController');

Route::group(['middleware'=>'auth'],function(){

	//Route::resource('discussions','DiscussionsController');
	Route::post('discussions/store','DiscussionsController@store')->name('discussions.store');

	Route::get('discussions/edit/{slug}','DiscussionsController@edit')->name('discussions.edit');

	Route::post('discussions/update/{id}','DiscussionsController@update')->name('discussions.update');

	Route::get('discussions/create','DiscussionsController@create')->name('discussions.create');

	Route::post('discussions/reply/{id}','DiscussionsController@reply')->name('discussions.reply');

	Route::get('discussions/watch/{id}','DiscussionsController@watch')->name('discussions.watch');

	Route::get('discussions/unwatch/{id}','DiscussionsController@unwatch')->name('discussions.unwatch');

	Route::get('/discussions/best/answer/{id}','RepliesController@best_answer')->name('reply.best.answer');

	Route::get('/reply/like/{id}','RepliesController@like')->name('reply.like');

	Route::get('/reply/unlike/{id}','RepliesController@unlike')->name('reply.unlike');

	Route::get('/replies/edit/{id}','RepliesController@edit')->name('replies.edit');

	Route::post('/replies/update/{id}','RepliesController@update')->name('replies.update');

	
});