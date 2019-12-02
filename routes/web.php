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

// 管理者未ログイン
Route::group(['prefix' => 'admin', 'namespace' => 'Admin\Auth'], function() {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::get('register', 'RegisterController@showRegisterForm')->name('admin.register');
    Route::post('register', 'RegisterController@register')->name('admin.register');
    Route::get('password/rest', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
});
// 管理者ログイン済
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function(){
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::resource('member', 'MembersController');


});

