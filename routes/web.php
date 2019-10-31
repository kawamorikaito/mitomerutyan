<?php

use App\Book;

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

//Route::get('/', 'bookController@index');
//Route::post('/book', 'bookController@regist');
//Route::get('/book', 'bookController@index');
//Route::delete('/book/{book}', 'bookController@delete');

Route::post('/', 'calendarController@index');
Route::get('/', 'calendarController@index');
Route::post('/{year}/{month}/{day}', 'calendarController@daydata');

Route::post('/regist', 'calendarController@regist');

Route::post('/update', 'calendarController@update');