<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConduitController;
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

/**
 * ルートをまとめて指定
 */
Route::prefix('conduit')
  // ->middleware(['auth']) // 認証機能をつける
  ->name('conduit.')
  ->controller(ConduitController::class)
  ->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/index/users_article', 'usersArticle')->name('usersArticle');
    Route::get('/editor', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/article/{id}', 'show')->name('show');
    Route::get('/article/{id}/edit', 'edit')->name('edit');
    Route::post('/article/{id}', 'update')->name('update');
    Route::post('/article/{id}/destroy', 'destroy')->name('destroy');
  });

Route::get('/index', [ConduitController::class, 'index']);

Route::get('/', function () {
  return view('welcome');
});

Route::get('/conduit/login', function () {
  return view('auth.login');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
