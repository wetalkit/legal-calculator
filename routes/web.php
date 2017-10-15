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

Route::get('/', 'WelcomeController@index');
Route::get('/about', 'WelcomeController@about');
Route::get('/report-bug', 'WelcomeController@reportBug');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::resource('admin/procedure', 'AdminProceduresController');
Route::get('admin/getProcedureItems', 'AdminProceduresController@getProcedureItems')->name('get_procedure_items');

Route::any('calculate', 'ProceduresController@calculate');
Route::resource('procedures', 'ProceduresController')->only(['index', 'show']);
