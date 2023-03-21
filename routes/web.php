<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;

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

// Route::resources([
//     'masyarakat' => MasyarakatController::class,
// ]);
Route::get('login', [LoginController::class, 'login']);
Route::get('register', [LoginController::class, 'register']);
Route::post('login', [LoginController::class, 'authanticate']);
Route::get('logout', [LoginController::class, 'logout']);

Route::post('masyarakat/store', [MasyarakatController::class, 'store']);
Route::middleware(['authmiddleware'])->group(function () {

    Route::get('masyarakat/add', [MasyarakatController::class, 'create'])->middleware('admin');
    Route::get('masyarakat/edit/{id}', [MasyarakatController::class, 'edit'])->middleware('admin');
    Route::get('masyarakat', [MasyarakatController::class, 'index'])->middleware('admin');
    Route::get('masyarakat/delete/{id}', [MasyarakatController::class, 'destroy'])->middleware('admin');
    Route::put('masyarakat/update/{id}', [MasyarakatController::class, 'update'])->middleware('admin');

    Route::get('petugas/add', [PetugasController::class, 'create'])->middleware('admin');
    Route::get('petugas/edit/{id}', [PetugasController::class, 'edit'])->middleware('admin');
    Route::get('petugas', [PetugasController::class, 'index'])->middleware('admin');
    Route::post('petugas/store', [PetugasController::class, 'store'])->middleware('admin');
    Route::get('petugas/delete/{id}', [PetugasController::class, 'destroy'])->middleware('admin');
    Route::put('petugas/update/{id}', [PetugasController::class, 'update'])->middleware('admin');
});

Route::get('pengaduan/add', [PengaduanController::class, 'create']);
Route::get('pengaduan/edit/{id}', [PengaduanController::class, 'edit']);
Route::get('/pengaduan', [PengaduanController::class, 'index']);
Route::get('/pengaduanku', [PengaduanController::class, 'pengaduanku']);
Route::get('/pengaduan/detail/{id}', [PengaduanController::class, 'show'])->middleware('authmiddleware');
Route::post('pengaduan/store', [PengaduanController::class, 'store']);
Route::get('pengaduan/delete/{id}', [PengaduanController::class, 'destroy']);
Route::put('pengaduan/update/{id}', [PengaduanController::class, 'update']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/{status}', [AdminController::class, 'show']);

Route::get('tanggapan/add/{id_pengaduan}', [TanggapanController::class, 'create']);
Route::get('tanggapan/edit/{id}', [TanggapanController::class, 'edit']);
Route::get('/tanggapan/detail/{id}', [TanggapanController::class, 'show']);
Route::post('tanggapan/store/{id_pengaduan}', [TanggapanController::class, 'store']);
Route::get('tanggapan/verif/{id_pengaduan}', [TanggapanController::class, 'verif']);
Route::get('tanggapan/delete/{id}', [TanggapanController::class, 'destroy']);
Route::put('tanggapan/update/{id}', [TanggapanController::class, 'update']);

Route::get('/', function () {
    return view('resource.landing');
});

Route::get('/home', function () {
    return view('home');
});
Route::get('/homepetugas', function () {
    return view('homepetugas');
});
Route::get('/homeadmin', function () {
    return view('homeadmin');
});