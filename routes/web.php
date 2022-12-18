<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\KembaliController;

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
    return view('welcome');
})->middleware(['auth', 'verified']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified', 'isadmin'])->group(function () {

    // kategori
    Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');

    Route::post('/kategori/add', [KategoriController::class, 'kategoriAdd'])->name('kategoriAdd');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'kategoriUpdate'])->name('kategoriUpdate');
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'kategoriDelete'])->name('kategoriDelete');

    // rak
    Route::get('/rak', [RakController::class, 'rak'])->name('rak');

    Route::post('/rak/add', [RakController::class, 'rakAdd'])->name('rakAdd');
    Route::post('/rak/update/{id}', [RakController::class, 'rakUpdate'])->name('rakUpdate');
    Route::get('/rak/delete/{id}', [RakController::class, 'rakDelete'])->name('rakDelete');

    // buku
    Route::get('/buku', [BukuController::class, 'buku'])->name('buku')->withoutMiddleware('isadmin');
    Route::get('/buku/detail/{id}', [BukuController::class, 'bukuDetail'])->name('bukuDetail')->withoutMiddleware('isadmin');

    Route::post('/buku/add', [BukuController::class, 'bukuAdd'])->name('bukuAdd');
    Route::post('/buku/update/cover/{id}', [BukuController::class, 'bukuUpdateCover'])->name('bukuUpdateCover');
    Route::post('/buku/update/detail/{id}', [BukuController::class, 'bukuUpdateDetail'])->name('bukuUpdateDetail');
    Route::get('/buku/delete/{id}', [BukuController::class, 'bukuDelete'])->name('bukuDelete');

    // pinjam
    Route::get('/pinjam', [PinjamController::class, 'pinjam'])->name('pinjam')->withoutMiddleware('isadmin');
    Route::get('/pinjam/request', [PinjamController::class, 'pinjamRequest'])->name('pinjamRequest');
    Route::get('/pinjam/request/terima/{id}', [PinjamController::class, 'pinjamRequestTerima'])->name('pinjamRequestTerima');
    Route::get('/pinjam/request/tolak/{id}', [PinjamController::class, 'pinjamRequestTolak'])->name('pinjamRequestTolak')->withoutMiddleware('isadmin');

    Route::post('/pinjam/admin/{id}', [PinjamController::class, 'pinjamAdmin'])->name('pinjamAdmin');
    Route::post('/pinjam/user/{id}', [PinjamController::class, 'pinjamUser'])->name('pinjamUser')->withoutMiddleware('isadmin');

    // kembali
    Route::get('/kembali/{id}', [KembaliController::class, 'kembali'])->name('kembali')->withoutMiddleware('isadmin');
    Route::get('/riwayat', [KembaliController::class, 'riwayat'])->name('riwayat')->withoutMiddleware('isadmin');
    Route::get('/riwayat/delete/{id}', [KembaliController::class, 'riwayatDelete'])->name('riwayatDelete')->withoutMiddleware('isadmin');
});