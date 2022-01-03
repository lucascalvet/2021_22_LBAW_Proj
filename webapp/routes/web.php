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

//Posts
/*
Route::get('post/create', 'PostController@create')->middleware('auth');
Route::post('post','PostController@store')->middleware('auth')->name('post');
Route::get('post/list','PostController@index')->middleware('auth')->name('posts.list');
Route::get('post/{id}','PostController@show')->name('posts.single');
Route::get('post/edit/{id}','PostController@edit')->middleware('auth')->name('post.edit');
Route::patch('post/edit/{id}','PostController@update')->name('posts.update');
Route::delete('/post/{id}', 'PostController@destroy')->name('posts.destroy');
*/

//Content
Route::get('content/text/create', 'TextContentController@create')->middleware('auth')->name('textcontent.make');
Route::get('content/media/create', 'MediaContentController@create')->middleware('auth')->name('mediacontent.make');
Route::post('content/text/create','TextContentController@store')->middleware('auth')->name('textcontent.create');
Route::post('content/media/create','MediaContentController@store')->middleware('auth')->name('mediacontent.create');
Route::get('content/list','ContentController@index')->middleware('auth')->name('content.list');
Route::get('content/{id}','ContentController@show')->name('content.show');
Route::get('content/text/edit/{id}','TextContentController@edit')->middleware('auth')->name('textcontent.edit');
Route::get('content/media/edit/{id}','MediaContentController@edit')->middleware('auth')->name('mediacontent.edit');
Route::patch('content/text/edit/{id}','TextContentController@update')->name('textcontent.update');
Route::patch('content/media/edit/{id}','MediaContentController@update')->name('mediacontent.update');
Route::delete('content/delete/{id}', 'ContentController@destroy')->name('content.destroy');

// Profile
Route::get('profile/{user}', 'ProfileController@show');
Route::get('profile/{user}/edit', 'ProfileController@showEdit');

// Adiministration
Route::get('admin', 'AdminController@show');
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
Route::post('register', 'Auth\RegisterController@create')->name('register');

//Recover Password
Route::get('recoverPassword', 'ForgotController@show');

// List Card
Route::get('listCards', 'ListCardsController@show');
<<<<<<< HEAD

//Search
Route::get('search', 'SearchController@show');
=======
>>>>>>> 8d79cee (Updated routes)
