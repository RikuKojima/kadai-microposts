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

Route::get('/', 'MicropostsController@index');

//ユーザ登録のルーティング
Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

//ログイン・アウトのルート
Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

//ユーザについての情報を表示するページには、ログインしていないとアクセスできないようにする。
Route::group(['middleware' => ['auth']], function() {
    Route::resource('users' ,'UsersController', ['only' => ['index', 'show']] );
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        //お気に入り機能のルート
        Route::post('add_like','UserLikeController@store')->name('user.add_like');
        Route::delete('rm_like','UserLikeController@destroy')->name('user.rm_like');
        Route::get('like','UsersController@like')->name('users.like');
        //そのツイートがお気に入りされているユーザーの数、表示させる必要ある？
        
    });
    
    Route::resource('microposts','MicropostsController',['only' => ['store','destroy']]);
});

