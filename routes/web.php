<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('show');
});

Route::get('/','App\Http\Controllers\BookController@show')->name('show');
Route::delete('/deleteData/{id}', 'App\Http\Controllers\BookController@delete')->name('delete.user');
Route::post('/addBooks','App\Http\Controllers\BookController@add')->name('add');
Route::get('/updatePage/{id}', 'App\Http\Controllers\BookController@updateGetData');
Route::post('/updateData/{id}', 'App\Http\Controllers\BookController@update');


