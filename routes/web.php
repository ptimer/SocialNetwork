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

Route::post('/profile/upload_avatar', 'UserController@upload_avatar')->name('profile.upload_avatar')->middleware('auth');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/friends', 'UserController@my_friends')->name('my_friends')->middleware('auth');

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

Route::post('/people/make_subscriber', 'PeopleController@make_subscriber')
	->name('people.make_subscriber')
	->middleware('auth');

// SUBSCRIBERS
Route::get('/subscribers', 'UserController@subscribers')->name('subscribers')->middleware('auth');

// POSTS

Route::post('/post_record', 'PostsController@store')->name('post_record')->middleware('auth');
Route::get('/post_edit/{id}', 'PostsController@edit')->name('post_edit')->middleware('auth');
Route::post('/post_update', 'PostsController@update')->name('post_update')->middleware('auth');
Route::get('/post_delete/{id}', 'PostsController@destroy')->name('post_delete')->middleware('auth');

// TO LIKE

Route::get('/post_like', 'PostsController@post_like')->name('post_like')->middleware('auth');
Route::get('/post_dislike', 'PostsController@post_dislike')->name('post_dislike')->middleware('auth');

// GROUPS

Route::get('/group/{id}', 'Group\GroupController@index')->name('group.index');
Route::get('/groups/list', 'Group\GroupController@list')->name('group.list');
Route::post('/groups/subscribe', 'Group\GroupController@subscribe')->name('group.subscribe')->middleware('auth');
Route::post('/groups/unsubscribe', 'Group\GroupController@unsubscribe')->name('group.unsubscribe')->middleware('auth');
Route::post('/groups/createGroup', 'Group\GroupController@createGroup')->name('group.createGroup')->middleware('auth');
Route::get('/groups/myGroupsAdmin', 'Group\GroupController@myGroupsAdmin')->name('group.myGroupsAdmin')->middleware('auth');
Route::get('/groups/myGroups', 'Group\GroupController@myGroups')->name('group.myGroups')->middleware('auth');
Route::get('/groups/createGroup', 'Group\GroupController@createGroup')->name('group.createGroup')->middleware('auth');
Route::post('/groups/store', 'Group\GroupController@store')->name('group.store')->middleware('auth');

// MESSAGES

Route::get('/message/myMessages', 'Message\MessageController@myMessages')->name('message.myMessages')->middleware('auth');
Route::get('message/contacts', 'Message\MessageController@contacts')->middleware('auth');
Route::get('/conversation/{id}', 'Message\MessageController@getMessagesFor')->middleware('auth');

Route::post('/conversation/send', 'Message\MessageController@send')->middleware('auth');