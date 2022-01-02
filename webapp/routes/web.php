<?php

use App\Http\Controllers\PostController;
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
Route::get('/', 'Auth\LoginController@home');
Route::get('home', 'HomeController@show');

//Posts
Route::get('post/create', 'PostController@create')->middleware('auth');
Route::post('post','PostController@store')->middleware('auth')->name('post');
Route::get('post/list','PostController@index')->middleware('auth')->name('posts.list');
Route::get('post/{id}','PostController@show')->name('posts.single');
Route::get('post/edit/{id}','PostController@edit')->middleware('auth')->name('post.edit');
Route::patch('post/edit/{id}','PostController@update')->name('posts.update');

// Profile
Route::get('profile', 'ProfileController@show');
Route::get('profile/edit', 'ProfileController@showEdit');

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