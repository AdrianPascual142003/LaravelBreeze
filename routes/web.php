<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GangaController;

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

/*
Route::get('/', function () {
    return view('welcome');
})->name("inici");
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/','GangaController@index')->name('inici');
Route::resource('gangas',GangaController::class);

Route::resource('categories',CategoryController::class);

Route::get('/',[GangaController::class, 'index'])->name('inici');

Route::get('/gangas/{id}/like',[GangaController::class,'doLike'])->name('gangas.like');
Route::get('/gangas/{id}/unlike',[GangaController::class, 'doUnlike'])->name('gangas.dislike');
Route::get('/news',[GangaController::class, 'recents'])->name('gangas.recents');
Route::get('/bests',[GangaController::class, 'getBestAvg'])->name('gangas.bests');

Route::resource('gangas', GangaController::class)->middleware('auth')->except('index','show');
Route::resource('gangas', GangaController::class)->middleware('valid')->only('edit','update');
Route::resource('categories', CategoryController::class)->middleware('catAuth');
Route::resource('categories', CategoryController::class)->middleware('auth')->only('*');

require __DIR__.'/auth.php';
