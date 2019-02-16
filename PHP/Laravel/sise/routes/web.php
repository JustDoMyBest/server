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

//Route::get('/threads','ThreadController@index');
//Route::post('/threads','ThreadController@store');
//Route::get('/threads/{thread}','ThreadController@show');

//Route::resource('threads', 'ThreadController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('threads','ThreadController@index');
Route::get('threads/create','ThreadController@create');
Route::get('threads/{channel}','ThreadController@index');
Route::get('threads/{channel}/{thread}','ThreadController@show');
Route::delete('threads/{channel}/{thread}','ThreadController@destroy');
Route::post('threads','ThreadController@store');
Route::get('/threads/{channel}/{thread}/replies','ReplyController@index');
Route::post('/threads/{channel}/{thread}/replies','ReplyController@store');

Route::patch('/replies/{reply}','ReplyController@update');
Route::delete('/replies/{reply}','ReplyController@destroy');
Route::post('/replies/{reply}/favorites','FavoritesController@store');
Route::delete('/replies/{reply}/favorites','FavoritesController@destroy');
Route::post('/threads/{channel}/{thread}/subscriptions','ThreadSubscriptionController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions','ThreadSubscriptionController@destroy')->middleware('auth');
// Route::post('/threads/{channel}/{thread}/subscriptions','ThreadSubscriptionController@store');
// Route::delete('/threads/{channel}/{thread}/subscriptions','ThreadSubscriptionController@destroy');

Route::get('/profiles/{user}','ProfilesController@show')->name('profile');
Route::get('/profiles/{user}/notifications','UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}','UserNotificationsController@destroy');

Route::get('api/users','Api\UsersController@index');
Route::post('api/users/{user}/avatar','Api\UserAvatarController@store')->middleware('auth')->name('avatar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

require base_path('routes/sise/web.php');

Route::get('/upload', 'UploadController@uploadForm');
Route::post('/upload', 'UploadController@uploadSubmit');
