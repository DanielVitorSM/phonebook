<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [ContactController::class, 'show'])->middleware('auth');
Route::view('/add', 'contacts/add')->middleware('auth');
Route::post('/add', [ContactController::class, 'store'])->middleware('auth');
Route::get('/delete/{id}', [ContactController::class, 'delete'])->middleware('auth');
Route::post('/update/{id}', [ContactController::class, 'update'])->middleware('auth');
Route::get('/{cell}', [ContactController::class, 'find'])->middleware('auth');

/**
 * Authentication Routes
 */
Route::view('/user/login', 'auth/login')->name('login')->middleware('guest');
Route::post('/user/login', [AuthController::class, 'attempt'])->name('login')->middleware('guest');
Route::view('/user/register', 'auth/register')->name('register')->middleware('guest');
Route::post('/user/register', [AuthController::class, 'store'])->middleware('guest');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');