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
Route::get('/', 'OrdersController@index');
Route::post('orders/create', 'OrdersController@create')->middleware('auth');
Route::post('orders/confirm', 'OrdersController@confirm')->middleware('auth');
Route::post('orders/complete', 'OrdersController@complete')->middleware('auth');
Route::get('orders/history', 'OrdersController@history')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function() {
    Route::get('/', function () {
        return view('admin.welcome');
    });
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');

    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
    
    Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
    Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');
    
    Route::get('password/rest', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    
    
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    
    
   Route::get('tickets/create', 'Admin\TicketsController@add');
   Route::post('tickets/create', 'Admin\TicketsController@create'); 
   Route::get('tickets', 'Admin\TicketsController@index');
   Route::get('tickets/edit', 'Admin\TicketsController@edit');
   Route::post('tickets/edit', 'Admin\TicketsController@update');
   Route::get('tickets/delete', 'Admin\TicketsController@delete');
});

