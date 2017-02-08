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
Route::get('data/{id}', 'HomeController@show');
Route::get('icds/{id}', 'HomeController@icds');
Route::get('aggregates/{id}', 'HomeController@aggregates');

Route::get('chart', 'ChartController@index');
Route::get('chart/{id}', 'ChartController@show');
