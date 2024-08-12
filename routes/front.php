<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\PenyiarController;
use App\Http\Controllers\ProfilController;

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

Route::get('/playlist', function () {
    return view('playlist');
});
Route::get('/streaming', function () {
    return view('streaming');
});


Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/foto/detail/{id}', [GaleriController::class, 'show'])->name('galeri.show');
// Events
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/{events:slug}', [EventsController::class, 'show'])->name('events.show');
// Article
Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.show');
// Watch
Route::get('/watch', [WatchController::class, 'index'])->name('watch.index');
// Program
Route::get('/programs', [ProgramsController::class, 'index'])->name('programs.index');
Route::get('/programs/{programs:slug}', [ProgramsController::class, 'show'])->name('programs.show');
// Penyiar
Route::get('/penyiar', [PenyiarController::class, 'index'])->name('penyiar.index');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
