<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Xin chào Laravel 12!';
})
;
Route::get('/time', function () {
    // Dùng Carbon (helper now()) để định dạng thời gian
    return now()->format('H:i:s d/m/Y');
});

Route::get('/sum/{a}/{b}', function ($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        return response('Tham số phải là số nguyên', 400);
    }
    return (int) $a + (int) $b;
});


Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/db', [StudentController::class, 'indexDb']);

// Student create form and store
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::get('/about', [PageController::class, 'about']);