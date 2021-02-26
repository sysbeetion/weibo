<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::resource('users', 'UsersController'); //批量路由

//用上面的批量路由可以吗？
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');


Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//showLinkRequestForm —— 填写 Email 的表单
// sendResetLinkEmail —— 处理表单提交，成功的话就发送邮件，附带 Token 的链接
// showResetForm —— 显示更新密码的表单，包含
// tokenreset —— 对提交过来的 token 和 email 数据进行配对，正确的话更新密码
Route::get('password/reset',  'PasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email',  'PasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}',  'PasswordController@showResetForm')->name('password.reset');
Route::post('password/reset',  'PasswordController@reset')->name('password.update');


Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
