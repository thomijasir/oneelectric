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

Route::get('/','MainController@index')->name('main');
Route::get('/all','MainController@all')->name('getall');
Route::get('/detected/{sensor}','MainController@detected')->name('detected');
Route::get('/jsongraph','MainController@json_graph')->name('jsongraph');
Route::get('/jsongraphs','MainController@json_graphs')->name('jsongraphs');
Route::get('/jsongraphs/{date}','MainController@jsonGraphDate')->name('jsonGraphDate');
Route::get('/jsoncomparedate','MainController@jsonCompareDate')->name('jsonCompareDate');