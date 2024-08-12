<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/user', [ApiController::class, 'getUserData']);
Route::get('/berita', [ApiController::class, 'getBerita']);
Route::get('/berita/{id}', [ApiController::class, 'getBeritaDetail']);
Route::get('/program', [ApiController::class, 'getProgram']);
Route::get('/program/{id}', [ApiController::class, 'getProgramDetail']);
Route::get('/event', [ApiController::class, 'getEvent']);
Route::get('/event/{id}', [ApiController::class, 'getEventDetail']);
Route::get('/host', [ApiController::class, 'getHost']);
Route::get('/host/{id}', [ApiController::class, 'getHostDetail']);
Route::get('/video', [ApiController::class, 'getVideo']);
Route::get('/logout', [ApiController::class, 'logout']);
// });
