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

Route::post('/profile/upload_avatar', 'UserController@upload_avatar')->name('profile.upload_avatar');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/friends', 'UserController@my_friends')->name('my_friends');

// PEOPLE
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