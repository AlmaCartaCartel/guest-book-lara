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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'CommentsController@index');

Route::post('/comments/add', 'CommentsController@store')->name('comment.add');
Route::get('/comments/all', 'CommentsController@all');
Route::get('/comments/form', 'CommentsController@form');
