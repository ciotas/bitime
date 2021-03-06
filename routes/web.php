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

Route::get('/', 'TopicsController@index')->name('root');

//Auth::routes();

// 用户身份验证相关的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册相关路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密码重置相关路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/search', 'TopicsController@search')->name('topics.search');

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
Route::resource('tags', 'TagsController', ['only' => ['show']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

Route::get('/users/{user_id}/plans', 'PlansController@index')->name('plans.index');

Route::resource('plans', 'PlansController', ['except'=> ['show']]);
Route::get('plans/search', 'PlansController@search')->name('plans.search');

Route::post('users/subscribe', 'SubscribeController@store')->name('users.subscribe.store');
Route::delete('users/subscribe', 'SubscribeController@destroy')->name('users.subscribe.destroy');

Route::resource('asks', 'AsksController');
Route::get('asks/sorts/lists', 'AsksController@listAsks')->name('asks.sorts.lists');
route::get('asks/my/replies', 'AsksController@replies')->name('asks.replies');
Route::get('users/plans/booking', 'PlansController@book')->name('uses.plans.booking');

Route::resource('analyzers', 'AnalyzersController', ['only' => ['update', 'store']]);
Route::get('asks/{ask}/over', 'AsksController@done')->name('asks.over');
Route::get('users/income/analysis', 'UsersController@analysis')->name('users.income.analysis');

