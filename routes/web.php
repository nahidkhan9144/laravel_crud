<?php

use App\Http\Controllers\ProfileController;
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
    return view('pages.login');
})->name('loginPage');

Route::post('/logins','App\Http\Controllers\BookController@loginCredential');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/goToHome', function () {
        return view('pages/home');
    });
    
    // Route::post('/login','App\Http\Controllers\BookController@loginCredential');
    Route::get('/table','App\Http\Controllers\BookController@show')->name('show');
    Route::delete('/deleteData/{id}', 'App\Http\Controllers\BookController@delete')->name('delete.user');
    Route::post('/addBooks','App\Http\Controllers\BookController@add')->name('add');
    Route::get('/logout','App\Http\Controllers\BookController@logoutCredential')->name('logout');
    Route::get('/updatePage/{id}', 'App\Http\Controllers\BookController@updateGetData');
    Route::post('/updateData/{id}', 'App\Http\Controllers\BookController@update');
});

require __DIR__.'/auth.php';
