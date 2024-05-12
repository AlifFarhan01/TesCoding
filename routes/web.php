<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PenyewaanController;
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

Route::middleware(['guest'])->group(function(){
Route::get('/',[AuthController::class,'index'])->name('login');
Route::post('/',[AuthController::class,'login']);


});
Route::get('/register',[AuthController::class,'regisview'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('regis');

Route::middleware(['auth'])->group(function(){
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('userAkses:penyewa');
Route::post('/penyewaan', [PenyewaanController::class, 'store'])->name('penyewaan.store')->middleware('userAkses:penyewa');
Route::get('/pengembalian', [HomeController::class, 'pengembalian'])->name('pengembalian')->middleware('userAkses:penyewa');
Route::get('/pengembalian/search', [HomeController::class, 'search'])->name('pengembalian.search')->middleware('userAkses:penyewa');
Route::put('/pengembalian/update/{id}', [PenyewaanController::class, 'update'])->name('pengembalian.update')->middleware('userAkses:penyewa');
Route::get('/kelolakendaraan', [KendaraanController::class, 'index'])->name('kelolakendaraan.index')->middleware('userAkses:pemilik');
Route::get('/kelolakendaraan/create', [KendaraanController::class, 'create'])->name('kelolakendaraan.create')->middleware('userAkses:pemilik');
Route::post('/kelolakendaraan', [KendaraanController::class, 'store'])->name('kelolakendaraan.store')->middleware('userAkses:pemilik');
Route::get('/kelolakendaraan/edit/{id}', [KendaraanController::class, 'edit'])->name('kelolakendaraan.edit')->middleware('userAkses:pemilik');
Route::put('/kelolakendaraan/update/{id}', [KendaraanController::class, 'update'])->name('kelolakendaraan.update')->middleware('userAkses:pemilik');
Route::delete('/kelolakendaraan/destroy/{id}', [KendaraanController::class, 'destroy'])->name('kelolakendaraan.destroy')->middleware('userAkses:pemilik');
});

// 
// 
// 



// 
// 
//
// 
// ;
// 

// 

