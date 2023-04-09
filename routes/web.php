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
});
