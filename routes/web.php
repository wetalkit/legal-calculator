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

Route::resource('/', 'WelcomeController')->only(['index']);
Route::get('/getItemsByProcedure/', 'WelcomeController@getItemsByProcedure')->name('get_items');
Route::post('/calculate/', 'WelcomeController@calculate')->name('calculate');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::resource('admin/procedure', 'AdminProceduresController');
