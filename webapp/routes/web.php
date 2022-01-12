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

// Home
Route::get('/', 'HomeController@show')->name('home');

// Content
Route::get('content/text/create', 'TextContentController@create')->middleware('auth')->name('textcontent.make');
Route::get('content/media/create', 'MediaContentController@create')->middleware('auth')->name('mediacontent.make');
Route::post('content/text/create','TextContentController@store')->middleware('auth')->name('textcontent.create');
Route::post('content/media/create','MediaContentController@store')->middleware('auth')->name('mediacontent.create');
Route::get('content/list','ContentController@index')->middleware('auth')->name('content.list');
Route::get('content/{id}','ContentController@show')->name('content.show');
Route::get('content/edit/{id}','ContentController@edit')->middleware('auth')->name('content.edit');
/* 
Route::get('content/text/edit/{id}','TextContentController@edit')->middleware('auth')->name('textcontent.edit');
Route::get('content/media/edit/{id}','MediaContentController@edit')->middleware('auth')->name('mediacontent.edit'); 
*/
Route::patch('content/text/edit/{id}','TextContentController@update')->middleware('auth')->name('textcontent.update');
Route::patch('content/media/edit/{id}','MediaContentController@update')->middleware('auth')->name('mediacontent.update');
Route::delete('content/delete/{id}', 'ContentController@destroy')->middleware('auth')->name('content.destroy');

// Profile
Route::get('profile/{user}', 'ProfileController@show')->name('profile');
Route::get('profile/{user}/edit', 'ProfileController@showEdit')->name('profile.edit');
Route::get('profile/{user}/save', 'ProfileController@save')->name('profile.save');
Route::post('profile/{user}/friendRequest', 'FriendRequestController@addFriend')->name('profile.addFriend');
Route::post('profile/{user}/friendRequest/accept', 'FriendRequestController@acceptFriend')->name('profile.acceptFriend');
Route::post('profile/{user}/friendRequest/reject', 'FriendRequestController@rejectFriend')->name('profile.rejectFriend');

// Adiministration
Route::get('admin', 'AdminController@show')->name('admin');
Route::get('admin/accounts', 'AdminController@showAccounts');
Route::get('admin/posts', 'AdminController@showPosts');
Route::get('admin/statistics', 'AdminController@showStatistics');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// Recover Password
Route::get('recoverPassword', 'ForgotController@show');

// List Card
Route::get('listCards', 'ListCardsController@show');

//Search
Route::get('search/users', 'SearchController@searchUsers')->name('search.users');
Route::get('search/content', 'SearchController@searchPosts')->name('search.content');
Route::get('search', 'SearchController@searchUsers')->name('search');

// Notifications
Route::get('/notifications', 'HomeController@show')->name('notifications');

// Chat
Route::get('/chat', 'HomeController@show')->name('chat');

// Groups
Route::get('/groups', 'HomeController@show')->name('groups');
