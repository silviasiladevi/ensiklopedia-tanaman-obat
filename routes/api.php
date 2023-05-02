<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanamanApiController;
use App\Http\Controllers\AkunApiController;
use App\Http\Controllers\ReportApiController;
use App\Http\Controllers\AboutApiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookmarkApiController;
use App\Http\Controllers\LikeApiController;
use App\Http\Controllers\KategoriApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/login', [LoginController::class, 'loginApi']);
Route::get('/akun', [AkunApiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/akun/edit/{username}', [AkunApiController::class, 'update'])->middleware('auth:sanctum');

Route::post('/tanaman', [TanamanApiController::class, 'store']);
Route::post('/tanaman/file', [TanamanApiController::class, 'storefile']);
Route::get('/tanaman', [TanamanApiController::class, 'index']);
Route::get('/about', [AboutApiController::class, 'index']);
Route::get('/kategori', [KategoriApiController::class, 'index']);
Route::get('/tanaman/akar', [TanamanApiController::class, 'akar']);
// Route::get('/tanaman', [TanamanApiController::class, 'index'])->middleware('auth:sanctum');
Route::get('/tanaman/tanamanuser', [TanamanApiController::class, 'tanamanUser'])->middleware('auth:sanctum');
Route::post('/tanaman/report/{id}', [ReportApiController::class, 'store'])->middleware('auth:sanctum');
Route::get('/tanaman/{id}', [TanamanApiController::class, 'show']);
Route::post('/tanaman/{tanaman}', [TanamanApiController::class, 'updatefile']);
Route::delete('/tanaman/hapus/{tanaman}', [TanamanApiController::class, 'destroy']);

Route::get('/bookmark', [BookmarkApiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/bookmark/check', [BookmarkApiController::class, 'checkBookmark'])->middleware('auth:sanctum');
Route::post('/bookmark/add', [BookmarkApiController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/bookmark/{tanaman}', [BookmarkApiController::class, 'destroy'])->middleware('auth:sanctum');


Route::get('/favorite', [LikeApiController::class, 'favorite']);
Route::get('/favoriteWeek', [LikeApiController::class, 'favoriteWeek']);
Route::get('/like', [LikeApiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/like/check', [LikeApiController::class, 'checkLike'])->middleware('auth:sanctum');
Route::post('/like/add', [LikeApiController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/like/{tanaman}', [LikeApiController::class, 'destroy'])->middleware('auth:sanctum');




Route::post('/regis', [RegisApiController::class, 'store']);

Route::get('storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
})->where('path', '.*')->name('storage');
