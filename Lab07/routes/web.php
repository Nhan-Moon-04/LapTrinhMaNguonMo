<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Xin chào Laravel 12!';
});

Route::get('/time', function () {
    // Dùng Carbon (helper now()) để định dạng thời gian
    return now()->format('H:i:s d/m/Y');
});

Route::get('/sum/{a}/{b}', function ($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        return response('Tham số phải là số nguyên', 400);
    }
    return (int)$a + (int)$b;
});

Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/db', [StudentController::class, 'indexDb']);

Route::get('/students/combined', [StudentController::class, 'combined']);


// 1. Route có tham số động
Route::get('/articles/page/{page}', function ($page) {
    return "Trang bài viết số: " . (int)$page;
})->whereNumber('page')->name('articles.page');
// 2. Tham số tuỳ chọn + regex slug
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where('slug', '[a-z0-9-]+');
// 3. Route group với prefix
Route::prefix('admin')->group(function () {
    Route::get('/articles', fn() => 'Quản trị bài viết')
        ->name('admin.articles.index');
});

use App\Http\Controllers\ArticleController;
Route::resource('articles', ArticleController::class);


use App\Models\Article;
// Danh sách tất cả bài viết
Route::get('/articles', function () {
    $articles = Article::all();
    return view('articles.index', compact('articles'));
})->name('articles.index');

// Chi tiết 1 bài viết
Route::get('/articles/show/{id}', function ($id) {
    $article = Article::findOrFail($id);
    return view('articles.show', compact('article'));
})->name('articles.show');

// Xoá 1 bài viết
Route::delete('/articles/delete/{id}', function ($id) {
    Article::delete($id);
    return redirect()->route('articles.index')
                     ->with('success', "Bài viết #$id đã được xoá thành công!");
})->name('articles.destroy');