<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

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

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Products CRUD routes
Route::resource('products', ProductController::class)->except(['show']);

// Reports page for Bài tập 08
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
