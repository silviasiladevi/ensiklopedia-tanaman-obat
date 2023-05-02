<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\TanamanController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\KategoriController;


use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RegisController;
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

Route::get('/', [TanamanController::class, 'index'])->middleware('guest');
Route::get('/dashboard', [TanamanController::class, 'index']);
Route::get('/guest/{kategori}', [TanamanController::class, 'filterKategori']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/regis', [RegisController::class, 'index']);
Route::post('/regis', [RegisController::class, 'store']);
Route::get('/about', function () {
    return view('guest/about', [

        "title" => "About"
    ]);
});




Route::get('/admin', [AdminController::class, 'indexhome']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/homeAdmin', [AdminController::class, 'indexhome']);



Route::get('/tanaman/search', [TanamanController::class, 'search']);
Route::get('/about', [AboutController::class, 'index']);

Route::post('/tanaman', [TanamanController::class, 'store']);
Route::get('/homeAdmin/tambahTanaman', [TanamanController::class, 'create']);
Route::get('/homeAdmin/akun', [AdminController::class, 'kelolaAkunAdmin']);
Route::get('/homeAdmin/tanaman', [AdminController::class, 'kelolaTanaman']);
Route::delete('/homeAdmin/kategori/{kategori}', [KategoriController::class, 'destroy']);
Route::get('/homeAdmin/kategori', [AdminController::class, 'kelolaKategori']);
Route::post('/homeAdmin/kategori/add', [KategoriController::class, 'store']);

Route::get('/homeAdmin/about', [AdminController::class, 'kelolaAbout']);
Route::patch('/homeAdmin/akun/edit', [AdminController::class, 'updateAkunAdmin']);
Route::patch('/homeAdmin/about/edit', [AboutController::class, 'update']);
Route::get('/homeAdmin/bookmark', [BookmarkController::class, 'index']);
Route::get('/homeAdmin/report', [AdminController::class, 'kelolaReport']);
Route::delete('/homeAdmin/report/{report}', [ReportController::class, 'destroy']);
Route::delete('/homeAdmin/tanaman/{tanaman}', [TanamanController::class, 'destroy']);
Route::get('/homeAdmin/{tanaman}/edit', [TanamanController::class, 'edit']);
// Route::post('/homeAdmin/tanaman/{tanaman}/status', [TanamanController::class, 'updateStatus']);

Route::patch('/homeAdmin/{tanaman}', [TanamanController::class, 'update']);

Route::post('/homeAdmin/user/{username}', [UserController::class, 'updateJabatan']);
Route::delete('/homeAdmin/user/{username}', [UserController::class, 'destroy']);
Route::get('/homeAdmin/user', [AdminController::class, 'kelolauser']);


Route::get('/tanaman/{tanaman}/post', [TanamanController::class, 'post']);
