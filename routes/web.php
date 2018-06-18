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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','HtmlDownloaderController@index');
Route::post('/handlerFormApp','ApplicationController@handlerFormApp');
Route::post('/handlerFormCollection','CollectionController@handlerFormCollection');
Route::post('/','HtmlDownloaderController@handlerForm');
Route::get('/editcolllection/{id}','CollectionController@editCollection');
Route::post('/editcolllection','CollectionController@storeCollection');
