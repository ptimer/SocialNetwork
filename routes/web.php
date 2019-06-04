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

// PROFILE

Route::post('/profile/upload_avatar', 'UserController@upload_avatar')->name('profile.upload_avatar')->middleware('auth');;
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/friends', 'UserController@my_friends')->name('my_friends')->middleware('auth');;
Route::post('/post_record', 'UserController@post_record')->name('post_record')->middleware('auth');;

// PEOPLE AND FRIENDS
Route::get('/people', 'PeopleController@people')->name('people');
Route::post('/people/add_friend', 'PeopleController@add_friend')
	->name('people.add_friend')
	->middleware('auth');

Route::post('/people/cancel_friend', 'PeopleController@cancel_friend')
	->name('people.cancel_friend')
	->middleware('auth');

Route::post('/people/confirm_friend', 'PeopleController@confirm_friend')
	->name('people.confirm_friend')
	->middleware('auth');

Route::post('/people/delete_friend', 'PeopleController@delete_friend')
	->name('people.delete_friend')
	->middleware('auth');

// SUBSCRIBERS
Route::get('/subscribers', 'UserController@subscribers')->name('subscribers')->middleware('auth');;
