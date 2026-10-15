<?php

use App\Http\Controllers\BallPressController;
use App\Http\Controllers\BenangController;
use App\Http\Controllers\CircularFG;
use App\Http\Controllers\CircularLoomController;
use App\Http\Controllers\CuttingController;
use App\Http\Controllers\DenierProdukController;
use App\Http\Controllers\DensitasProdukController;
use App\Http\Controllers\FinishGoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KodebenangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LotextruderController;
use App\Http\Controllers\MachineLoomController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\SpecprodukController;
use App\Http\Controllers\SpecrollController;
use App\Http\Controllers\SpesifikasiController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WarnajahitanController;
use App\Models\FinishGood;
use App\Models\User;
use Illuminate\Auth\Events\Login;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('prodi', [HomeController::class, 'index'])->name('prodi');
Route::get('', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('login/keluar', [LoginController::class, 'keluar'])->name('login.keluar');

Route::get('users', [UsersController::class, 'index'])->name('users')->middleware('auth');
Route::get('users/create', [UsersController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('users', [UsersController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::put('users/update/{id}', [UsersController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('users/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('auth');


Route::get('spesifikasi', [SpesifikasiController::class, 'index'])->name('spesifikasi')->middleware('auth');
Route::get('spesifikasi/create', [SpesifikasiController::class, 'create'])->name('spesifikasi.create')->middleware('auth');
Route::post('spesifikasi', [SpesifikasiController::class, 'store'])->name('spesifikasi.store')->middleware('auth');
Route::get('spesifikasi/{id}/edit', [SpesifikasiController::class, 'edit'])->name('spesifikasi.edit')->middleware('auth');
Route::put('spesifikasi/update/{id}', [SpesifikasiController::class, 'update'])->name('spesifikasi.update')->middleware('auth');
Route::delete('spesifikasi/destroy/{id}', [SpesifikasiController::class, 'destroy'])->name('spesifikasi.destroy')->middleware('auth');

Route::get('lotextruder', [LotextruderController::class, 'index'])->name('lotextruder')->middleware('auth');
Route::get('lotextruder/create', [LotextruderController::class, 'create'])->name('lotextruder.create')->middleware('auth');
Route::post('lotextruder', [LotextruderController::class, 'store'])->name('lotextruder.store')->middleware('auth');
Route::get('lotextruder/{id}/edit', [LotextruderController::class, 'edit'])->name('lotextruder.edit')->middleware('auth');
Route::put('lotextruder/update/{id}', [LotextruderController::class, 'update'])->name('lotextruder.update')->middleware('auth');
Route::delete('lotextruder/destroy/{id}', [LotextruderController::class, 'destroy'])->name('lotextruder.destroy')->middleware('auth');

Route::get('kodebenang', [KodebenangController::class, 'index'])->name('kodebenang')->middleware('auth');
Route::get('kodebenang/create', [KodebenangController::class, 'create'])->name('kodebenang.create')->middleware('auth');
Route::post('kodebenang', [KodebenangController::class, 'store'])->name('kodebenang.store')->middleware('auth');
Route::get('kodebenang/{id}/edit', [KodebenangController::class, 'edit'])->name('kodebenang.edit')->middleware('auth');
Route::put('kodebenang/update/{id}', [KodebenangController::class, 'update'])->name('kodebenang.update')->middleware('auth');
Route::delete('kodebenang/destroy/{id}', [KodebenangController::class, 'destroy'])->name('kodebenang.destroy')->middleware('auth');

Route::get('benang', [BenangController::class, 'index'])->name('benang')->middleware('auth');
Route::get('benang/create', [BenangController::class, 'create'])->name('benang.create')->middleware('auth');
Route::post('benang', [BenangController::class, 'store'])->name('benang.store')->middleware('auth');
Route::get('benang/{id}/edit', [BenangController::class, 'edit'])->name('benang.edit')->middleware('auth');
Route::get('benang/{id}/show', [BenangController::class, 'show'])->name('benang.show')->middleware('auth');
Route::post('benang/cari', [BenangController::class, 'cari'])->name('benang.cari')->middleware('auth');
Route::post('benang/proses', [BenangController::class, 'proses'])->name('benang.proses')->middleware('auth');
Route::get('benang/{id}/cetak', [BenangController::class, 'cetak'])->name('benang.cetak')->middleware('auth');
Route::put('benang/update/{id}', [BenangController::class, 'update'])->name('benang.update')->middleware('auth');
Route::get('benang/clear', [BenangController::class, 'clear'])->name('benang.clear')->middleware('auth');
Route::delete('benang/destroy/{id}', [BenangController::class, 'destroy'])->name('benang.destroy')->middleware('auth');
Route::get('benang/keluar', [BenangController::class, 'keluar'])->name('benang.keluar')->middleware('auth');
Route::delete('benang/keluar/destroy/{id}', [BenangController::class, 'delkeluar'])->name('benang.keluar.destroy')->middleware('auth');
Route::delete('benang/history/destroy/{id}', [BenangController::class, 'delhiskeluar'])->name('benang.history.destroy')->middleware('auth');
Route::get('benang/history', [BenangController::class, 'history'])->name('benang.history')->middleware('auth');
Route::get('benang/hexcel/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [BenangController::class, 'hexcel'])->name('benang.hexcel')->middleware('auth');
Route::post('benang/filterh', [BenangController::class, 'filterh'])->name('benang.filterh')->middleware('auth');
Route::get('benang/laporan', [BenangController::class, 'laporan'])->name('benang.laporan')->middleware('auth');
Route::get('benang/laporank', [BenangController::class, 'laporank'])->name('benang.laporank')->middleware('auth');
Route::post('benang/filter', [BenangController::class, 'filter'])->name('benang.filter')->middleware('auth');
Route::post('benang/filterk', [BenangController::class, 'filterk'])->name('benang.filterk')->middleware('auth');
Route::get('benang/excel/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [BenangController::class, 'excel'])->name('benang.excel')->middleware('auth');
Route::get('benang/excelk/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [BenangController::class, 'excelk'])->name('benang.excelk')->middleware('auth');
Route::get('benang/retur', [BenangController::class, 'retur'])->name('benang.retur')->middleware('auth');
Route::post('benang/retur', [BenangController::class, 'pretur'])->name('benang.pretur')->middleware('auth');

Route::get('specroll', [SpecrollController::class, 'index'])->name('specroll')->middleware('auth');
Route::get('specroll/create', [SpecrollController::class, 'create'])->name('specroll.create')->middleware('auth');
Route::post('specroll', [SpecrollController::class, 'store'])->name('specroll.store')->middleware('auth');
Route::get('specroll/{id}/edit', [SpecrollController::class, 'edit'])->name('specroll.edit')->middleware('auth');
Route::put('specroll/update/{id}', [SpecrollController::class, 'update'])->name('specroll.update')->middleware('auth');
Route::delete('specroll/destroy/{id}', [SpecrollController::class, 'destroy'])->name('specroll.destroy')->middleware('auth');

Route::get('machineloom', [MachineLoomController::class, 'index'])->name('machineloom')->middleware('auth');
Route::get('machineloom/create', [MachineLoomController::class, 'create'])->name('machineloom.create')->middleware('auth');
Route::post('machineloom', [MachineLoomController::class, 'store'])->name('machineloom.store')->middleware('auth');
Route::get('machineloom/{id}/edit', [MachineLoomController::class, 'edit'])->name('machineloom.edit')->middleware('auth');
Route::put('machineloom/update/{id}', [MachineLoomController::class, 'update'])->name('machineloom.update')->middleware('auth');
Route::delete('machineloom/destroy/{id}', [MachineLoomController::class, 'destroy'])->name('machineloom.destroy')->middleware('auth');

Route::get('circularloom', [CircularLoomController::class, 'index'])->name('circularloom')->middleware('auth');
Route::get('circularloom/create', [CircularLoomController::class, 'create'])->name('circularloom.create')->middleware('auth');
Route::post('circularloom', [CircularLoomController::class, 'store'])->name('circularloom.store')->middleware('auth');
Route::get('circularloom/{id}/edit', [CircularLoomController::class, 'edit'])->name('circularloom.edit')->middleware('auth');
Route::put('circularloom/update/{id}', [CircularLoomController::class, 'update'])->name('circularloom.update')->middleware('auth');
Route::delete('circularloom/destroy/{id}', [CircularLoomController::class, 'destroy'])->name('circularloom.destroy')->middleware('auth');

Route::get('circularloomfg', [CircularFG::class, 'index'])->name('circularloomfg')->middleware('auth');
Route::get('circularloomfg/create', [CircularFG::class, 'create'])->name('circularloomfg.create')->middleware('auth');
Route::post('circularloomfg', [CircularFG::class, 'store'])->name('circularloomfg.store')->middleware('auth');
Route::get('circularloomfg/{id}/edit', [CircularFG::class, 'edit'])->name('circularloomfg.edit')->middleware('auth');
Route::put('circularloomfg/update/{id}', [CircularFG::class, 'update'])->name('circularloomfg.update')->middleware('auth');
Route::delete('circularloomfg/destroy/{id}', [CircularFG::class, 'destroy'])->name('circularloomfg.destroy')->middleware('auth');

Route::get('roll', [RollController::class, 'index'])->name('roll')->middleware('auth');
Route::get('roll/gagal', [RollController::class, 'gagal'])->name('roll.gagal')->middleware('auth');
Route::get('roll/create', [RollController::class, 'create'])->name('roll.create')->middleware('auth');
Route::post('roll', [RollController::class, 'store'])->name('roll.store')->middleware('auth');
Route::get('roll/{id}/show', [RollController::class, 'show'])->name('roll.show')->middleware('auth');
Route::get('roll/{id}/cetak', [RollController::class, 'cetak'])->name('roll.cetak')->middleware('auth');
Route::get('roll/{id}/edit', [RollController::class, 'edit'])->name('roll.edit')->middleware('auth');
Route::put('roll/update/{id}', [RollController::class, 'update'])->name('roll.update')->middleware('auth');
Route::delete('roll/destroy/{id}', [RollController::class, 'destroy'])->name('roll.destroy')->middleware('auth');
Route::get('roll/clear', [RollController::class, 'clear'])->name('roll.clear')->middleware('auth');
Route::get('roll/getspek/{id}', [RollController::class, 'getspek'])->name('roll.getspek');
Route::get('roll/getcircular/{id}', [RollController::class, 'getcircular'])->name('roll.getcircular');
Route::delete('roll/keluar/destroy/{id}', [RollController::class, 'delkeluar'])->name('roll.keluar.destroy')->middleware('auth');
Route::delete('roll/history/destroy/{id}', [RollController::class, 'delhiskeluar'])->name('roll.history.destroy')->middleware('auth');
Route::get('roll/keluar', [RollController::class, 'keluar'])->name('roll.keluar')->middleware('auth');
Route::get('roll/scan', [RollController::class, 'scan'])->name('roll.scan')->middleware('auth');
Route::post('roll/cari', [RollController::class, 'cari'])->name('roll.cari')->middleware('auth');
Route::post('roll/proses', [RollController::class, 'proses'])->name('roll.proses')->middleware('auth');
Route::get('roll/history', [RollController::class, 'history'])->name('roll.history')->middleware('auth');
Route::get('roll/hexcel/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [RollController::class, 'hexcel'])->name('roll.hexcel')->middleware('auth');
Route::post('roll/filterh', [RollController::class, 'filterh'])->name('roll.filterh')->middleware('auth');
Route::get('roll/laporan', [RollController::class, 'laporan'])->name('roll.laporan')->middleware('auth');
Route::get('roll/laporank', [RollController::class, 'laporank'])->name('roll.laporank')->middleware('auth');
Route::get('roll/excel/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [RollController::class, 'excel'])->name('roll.excel')->middleware('auth');
Route::get('roll/excelk/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [RollController::class, 'excelk'])->name('roll.excelk')->middleware('auth');
Route::post('roll/filter', [RollController::class, 'filter'])->name('roll.filter')->middleware('auth');
Route::post('roll/filterk', [RollController::class, 'filterk'])->name('roll.filterk')->middleware('auth');
Route::get('roll/retur', [RollController::class, 'retur'])->name('roll.retur')->middleware('auth');
Route::post('roll/pretur', [RollController::class, 'pretur'])->name('roll.pretur')->middleware('auth');

Route::get('specproduk', [SpecprodukController::class, 'index'])->name('specproduk')->middleware('auth');
Route::get('specproduk/create', [SpecprodukController::class, 'create'])->name('specproduk.create')->middleware('auth');
Route::post('specproduk', [SpecprodukController::class, 'store'])->name('specproduk.store')->middleware('auth');
Route::get('specproduk/{id}/edit', [SpecprodukController::class, 'edit'])->name('specproduk.edit')->middleware('auth');
Route::put('specproduk/update/{id}', [SpecprodukController::class, 'update'])->name('specproduk.update')->middleware('auth');
Route::delete('specproduk/destroy/{id}', [SpecprodukController::class, 'destroy'])->name('specproduk.destroy')->middleware('auth');

Route::get('warna', [WarnajahitanController::class, 'index'])->name('warna')->middleware('auth');
Route::get('warna/create', [WarnajahitanController::class, 'create'])->name('warna.create')->middleware('auth');
Route::post('warna', [WarnajahitanController::class, 'store'])->name('warna.store')->middleware('auth');
Route::get('warna/{id}/edit', [WarnajahitanController::class, 'edit'])->name('warna.edit')->middleware('auth');
Route::put('warna/update/{id}', [WarnajahitanController::class, 'update'])->name('warna.update')->middleware('auth');
Route::delete('warna/destroy/{id}', [WarnajahitanController::class, 'destroy'])->name('warna.destroy')->middleware('auth');


Route::get('denier', [DenierProdukController::class, 'index'])->name('denier')->middleware('auth');
Route::get('denier/create', [DenierProdukController::class, 'create'])->name('denier.create')->middleware('auth');
Route::post('denier', [DenierProdukController::class, 'store'])->name('denier.store')->middleware('auth');
Route::get('denier/{id}/edit', [DenierProdukController::class, 'edit'])->name('denier.edit')->middleware('auth');
Route::put('denier/update/{id}', [DenierProdukController::class, 'update'])->name('denier.update')->middleware('auth');
Route::delete('denier/destroy/{id}', [DenierProdukController::class, 'destroy'])->name('denier.destroy')->middleware('auth');

Route::get('densitas', [DensitasProdukController::class, 'index'])->name('densitas')->middleware('auth');
Route::get('densitas/create', [DensitasProdukController::class, 'create'])->name('densitas.create')->middleware('auth');
Route::post('densitas', [DensitasProdukController::class, 'store'])->name('densitas.store')->middleware('auth');
Route::get('densitas/{id}/edit', [DensitasProdukController::class, 'edit'])->name('densitas.edit')->middleware('auth');
Route::put('densitas/update/{id}', [DensitasProdukController::class, 'update'])->name('densitas.update')->middleware('auth');
Route::delete('densitas/destroy/{id}', [DensitasProdukController::class, 'destroy'])->name('densitas.destroy')->middleware('auth');

Route::get('cutting', [CuttingController::class, 'index'])->name('cutting')->middleware('auth');
Route::get('cutting/create', [CuttingController::class, 'create'])->name('cutting.create')->middleware('auth');
Route::post('cutting', [CuttingController::class, 'store'])->name('cutting.store')->middleware('auth');
Route::get('cutting/{id}/edit', [CuttingController::class, 'edit'])->name('cutting.edit')->middleware('auth');
Route::put('cutting/update/{id}', [CuttingController::class, 'update'])->name('cutting.update')->middleware('auth');
Route::delete('cutting/destroy/{id}', [CuttingController::class, 'destroy'])->name('cutting.destroy')->middleware('auth');

Route::get('ballpress', [BallPressController::class, 'index'])->name('ballpress')->middleware('auth');
Route::get('ballpress/create', [BallPressController::class, 'create'])->name('ballpress.create')->middleware('auth');
Route::post('ballpress', [BallPressController::class, 'store'])->name('ballpress.store')->middleware('auth');
Route::get('ballpress/{id}/edit', [BallPressController::class, 'edit'])->name('ballpress.edit')->middleware('auth');
Route::put('ballpress/update/{id}', [BallPressController::class, 'update'])->name('ballpress.update')->middleware('auth');
Route::delete('ballpress/destroy/{id}', [BallPressController::class, 'destroy'])->name('ballpress.destroy')->middleware('auth');

Route::get('fgood', [FinishGoodController::class, 'index'])->name('fgood')->middleware('auth');
Route::get('fgood/create', [FinishGoodController::class, 'create'])->name('fgood.create')->middleware('auth');
Route::post('fgood', [FinishGoodController::class, 'store'])->name('fgood.store')->middleware('auth');
Route::get('fgood/{id}/edit', [FinishGoodController::class, 'edit'])->name('fgood.edit')->middleware('auth');
Route::put('fgood/update/{id}', [FinishGoodController::class, 'update'])->name('fgood.update')->middleware('auth');
Route::delete('fgood/destroy/{id}', [FinishGoodController::class, 'destroy'])->name('fgood.destroy')->middleware('auth');
Route::get('fgood/clear', [FinishGoodController::class, 'clear'])->name('fgood.clear')->middleware('auth');
Route::get('fgood/getproduk/{id}', [FinishGoodController::class, 'getproduk'])->name('roll.getproduk');
Route::get('fgood/getdensitas/{id}', [FinishGoodController::class, 'getdensitas'])->name('roll.getdensitas');
Route::get('fgood/{id}/cetak', [FinishGoodController::class, 'cetak'])->name('fgood.cetak')->middleware('auth');
Route::get('fgood/{id}/show', [FinishGoodController::class, 'show'])->name('fgood.show')->middleware('auth');
Route::get('fgood/keluar', [FinishGoodController::class, 'keluar'])->name('fgood.keluar')->middleware('auth');
Route::delete('fgood/keluar/destroy/{id}', [FinishGoodController::class, 'delkeluar'])->name('fgood.keluar.destroy')->middleware('auth');
Route::delete('fgood/history/destroy/{id}', [FinishGoodController::class, 'delhiskeluar'])->name('fgood.history.destroy')->middleware('auth');
Route::get('fgood/scan', [FinishGoodController::class, 'scan'])->name('fgood.scan')->middleware('auth');
Route::post('fgood/cari', [FinishGoodController::class, 'cari'])->name('fgood.cari')->middleware('auth');
Route::post('fgood/proses', [FinishGoodController::class, 'proses'])->name('fgood.proses')->middleware('auth');
Route::get('fgood/history', [FinishGoodController::class, 'history'])->name('fgood.history')->middleware('auth');
Route::get('fgood/excelh/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [FinishGoodController::class, 'excelh'])->name('fgood.excelh')->middleware('auth');
Route::post('fgood/filterh', [FinishGoodController::class, 'filterh'])->name('fgood.filterh')->middleware('auth');
Route::get('fgood/laporan', [FinishGoodController::class, 'laporan'])->name('fgood.laporan')->middleware('auth');
Route::get('fgood/laporank', [FinishGoodController::class, 'laporank'])->name('fgood.laporank')->middleware('auth');
Route::post('fgood/filter', [FinishGoodController::class, 'filter'])->name('fgood.filter')->middleware('auth');
Route::post('fgood/filterk', [FinishGoodController::class, 'filterk'])->name('fgood.filterk')->middleware('auth');
Route::get('fgood/excel/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [FinishGoodController::class, 'excel'])->name('fgood.excel')->middleware('auth');
Route::get('fgood/excelk/{tanggal1}/{tanggal2}/{jam1}/{jam2}', [FinishGoodController::class, 'excelk'])->name('fgood.excelk')->middleware('auth');
Route::get('fgood/retur', [FinishGoodController::class, 'retur'])->name('fgood.retur')->middleware('auth');
Route::post('fgood/pretur', [FinishGoodController::class, 'pretur'])->name('fgood.pretur')->middleware('auth');

Route::get('profil', [UsersController::class, 'profil'])->name('users.profil')->middleware('auth');
Route::put('profil/ubah/{id}', [UsersController::class, 'ubah'])->name('users.ubah')->middleware('auth');
