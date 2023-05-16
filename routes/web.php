<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndonesiaController;
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
    return redirect()->to('login');
});

// AUTH
Route::get('login', [AuthController::class, 'showLogin']);
Route::post('doLogin', [AuthController::class, 'doLogin']);
Route::get('register', [AuthController::class, 'showRegister']);
Route::post('doRegister', [AuthController::class, 'doRegister']);
Route::get('doLogout', [AuthController::class, 'doLogout']);
// END AUTH

// DATA INDONESIA
Route::get('getKota', [PasienController::class, 'getKota']);
Route::get('getKecamatan', [PasienController::class, 'getKecamatan']);
// END DATA INDO
Route::group(['middleware' => ['login']], function(){
    Route::get('pendaftaran-pasien', [PasienController::class, 'index']);
    Route::post('pendaftaran-pasien/daftar', [PasienController::class, 'daftar_pasien']);
    Route::post('doReservasi', [PasienController::class, 'doReservasi']);
    Route::get('reservasi', [PasienController::class, 'form_reservasi']);
    Route::get('poliklinik', [PasienController::class, 'poliklinik']);
});

// Admin
Route::group(['middleware' => ['login_admin']], function(){
    Route::post('ubah-status-reservasi/{id}', [AdminController::class, 'ubah_status']);
    Route::get('master-poli', [AdminController::class, 'master_poli']);
    Route::post('master-poli-simpan', [AdminController::class, 'master_poli_simpan']);
    Route::post('master-poli-update/{id}', [AdminController::class, 'master_poli_update']);
    Route::post('master-poli-delete/{id}', [AdminController::class, 'master_poli_delete']);
    Route::get('master-jadwal', [AdminController::class, 'master_jadwal']);
    Route::post('master-jadwal-simpan', [AdminController::class, 'master_jadwal_simpan']);
    Route::post('master-jadwal-update/{id}', [AdminController::class, 'master_jadwal_update']);
    Route::post('master-jadwal-delete/{id}', [AdminController::class, 'master_jadwal_delete']);
    Route::get('home-admin', [AdminController::class, 'home']);
});
