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


Route::get('/', 'HomeController@index');
Route::get('/admin-panel', 'Auth\AdminLoginController@showLoginForm');


Route::get('/login', 'Auth\LoginController@shopifyLogin')->name('login');
Route::get('/dashboard', 'CustomerController@customer_dashboard')->name('dashboard');

Route::get('/logout', 'CustomerController@customer_logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view_proof', 'HomeController@pop_background')->name('view_proof');

Route::post('/ax_check_login', 'Auth\LoginController@ax_check_login');
Route::post('/ax_fix_request', 'OrderController@ax_fix_request');
Route::post('/apply_order', 'OrderController@apply_order');
Route::post('/ax_save_background', 'HomeController@ax_save_background');
Auth::routes();

/*admin*/

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', 'admin\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/orders', 'admin\OrderController@all_order');
    Route::get('/add_background_type', 'admin\BackgroundController@add_background_type');
    Route::get('/add_background', 'admin\BackgroundController@add_background');
    Route::get('/all_background', 'admin\BackgroundController@all_background');
    Route::get('/upload_image/{id}', 'admin\OrderController@upload_image')->where('id', '[0-9]+');
    Route::get('/login', 'Auth\AdminController@showLoginForm')->name('admin.login');
    Route::get('/change_background/{id}', 'admin\BackgroundController@change_background');
    Route::get('/all_customer', 'admin\CustomerController@all_customer');
    Route::get('/order_notes', 'admin\OrderController@order_notes');

    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/upload_file', 'admin\OrderController@ax_upload_file');
    Route::post('/add_background_cat', 'admin\BackgroundController@ax_add_background_cat');
    Route::post('/upload_background', 'admin\BackgroundController@ax_add_background');
});

/*admin*/