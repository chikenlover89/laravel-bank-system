<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/flog', 'AccountsController@flog')->middleware(['auth']);
Route::get('/accounts', 'AccountsController@show')->name('accounts')->middleware(['auth']);
Route::get('/debt', 'AccountsController@debt')->name('debt')->middleware(['auth']);
Route::post('/send', 'AccountsController@send')->name('send')->middleware(['auth']);
Route::get('/history', 'TransactionsController@show')->name('history')->middleware(['auth']);
