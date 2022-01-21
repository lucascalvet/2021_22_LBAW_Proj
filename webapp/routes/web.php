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
/*
Route::get($known_route, function() use ($id) {
    return App::make('SomeController')->someMethod($id);
});
*/
Route::get('content/text/create/{id_group?}', 'TextContentController@create')->middleware('auth')->name('textcontent.make');
Route::get('content/media/create/{id_group?}', 'MediaContentController@create')->middleware('auth')->name('mediacontent.make');
Route::post('content/text', 'TextContentController@store')->middleware('auth')->name('textcontent.create');
Route::post('content/media', 'MediaContentController@store')->middleware('auth')->name('mediacontent.create');
Route::get('content/{id}', 'ContentController@show')->whereNumber('id')->name('content.show');
Route::get('content/{id}/edit', 'ContentController@edit')->whereNumber('id')->middleware('auth')->name('content.edit');

//Like content
Route::post('content/{id}/like', 'ContentController@like')->middleware('auth')->name('content.like');
Route::patch('content/{id}', 'ContentController@update')->middleware('auth')->name('content.update');
Route::delete('content/{id}', 'ContentController@destroy')->middleware('auth')->name('content.destroy');
Route::patch('content/{id}/remove', 'ContentController@remove')->middleware('auth')->name('content.remove');

// Comments
Route::post('content/{id}/comment', 'ContentController@comment')->name('content.comment');

// Profile
Route::get('profile/{user}', 'ProfileController@show')->name('profile');
Route::delete('profile/{user}', 'ProfileController@destroy')->name('profile.destroy');
Route::get('profile/{user}/edit', 'ProfileController@showEdit')->name('profile.edit');
Route::patch('profile/{user}', 'ProfileController@save')->name('profile.save');
Route::post('profile/{user}/friendRequest', 'FriendRequestController@addFriend')->name('profile.addFriend');
Route::post('profile/{user}/cancelFriendRequest', 'FriendRequestController@cancelFriend')->name('profile.cancelFriend');
Route::post('profile/friendRequest/{friendRequestId}/accept', 'FriendsController@acceptFriend')->name('profile.acceptFriend');
Route::post('profile/friendRequest/{friendRequestId}/reject', 'FriendsController@rejectFriend')->name('profile.rejectFriend');
Route::post('profile/{user}/friendRemove', 'FriendsController@removeFriend')->name('profile.removeFriend');

// Adiministration
Route::get('admin', 'AdminController@show')->name('admin');
Route::get('admin/accounts', 'AdminController@showAccounts');
Route::get('admin/posts', 'AdminController@showPosts');
Route::get('admin/statistics', 'AdminController@showStatistics');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// Recover Password
Route::get('recoverPassword', 'ForgotController@show');

//Search
Route::get('search/users', 'SearchController@searchUsers')->name('search.users');
Route::get('search/content', 'SearchController@searchPosts')->name('search.content');
Route::get('search/groups', 'SearchController@searchGroups')->name('search.groups');
Route::redirect('search', 'search/content')->name('search');

// Notifications
Route::get('/notifications', 'NotificationsController@all')->middleware('auth')->name('notifications');
Route::get('/notifications/friends_requests', 'NotificationsController@friends')->middleware('auth')->name('notifications.friend_requests');
Route::get('/notifications/likes', 'NotificationsController@likes')->middleware('auth')->name('notifications.likes');
Route::get('/notifications/comments', 'NotificationsController@comments')->middleware('auth')->name('notifications.comments');

// Chat
Route::get('chat', 'HomeController@show')->name('chat');

// Groups
Route::get('groups', 'GroupController@showHub')->name('groups');
Route::get('group/create', 'GroupController@create')->middleware('auth')->name('group.make');
Route::post('group/create', 'GroupController@store')->middleware('auth')->name('group.create');
Route::get('group/{id}', 'GroupController@show')->name('group.show');
Route::get('group/{id}/edit', 'GroupController@edit')->middleware('auth')->name('group.edit');
Route::patch('group/{id}', 'GroupController@update')->middleware('auth')->name('group.update');
Route::delete('group/{id}', 'GroupController@destroy')->middleware('auth')->name('group.destroy');
Route::post('group/{id}/join/{user}', 'GroupController@memberJoin')->middleware('auth')->name('group.member.join');
Route::post('group/{id}/leave/{user}', 'GroupController@memberLeave')->middleware('auth')->name('group.member.leave');
Route::post('group/{id}/modjoin/{user}', 'GroupController@modJoin')->middleware('auth')->name('group.mod.join');
Route::post('group/{id}/modleave/{user}', 'GroupController@modLeave')->middleware('auth')->name('group.mod.leave');

//Comments
Route::delete('comment/{id}', 'CommentController@destroy')->middleware('auth')->name('comment.destroy');

//Static Pages
Route::get('faq', 'StaticPagesController@showFAQ')->name('faq');
Route::get('features', 'StaticPagesController@showFeatures')->name('features');
Route::get('contacts', 'StaticPagesController@showContacts')->name('contacts');
Route::get('about', 'StaticPagesController@showAbout')->name('about');
