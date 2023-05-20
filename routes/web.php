<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonaturController;

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

Route::get('/', function () {
    return view('mainweb');
})->name('mainweb');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::prefix('user')->group(function () {
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
});

// Donatur
Route::prefix('donatur')->group(function () {
    Route::get('/login', [DonaturController::class, 'login'])->name('donatur.login');
    Route::get('/dashboard', [DonaturController::class, 'dashboard'])->name('donatur.dashboard');
    Route::get('/donasi', [DonaturController::class, 'donasi'])->name('donatur.donasi');
    Route::get('/profile', [DonaturController::class, 'profile'])->name('donatur.profile');
    Route::get('/detail-donasi', [DonaturController::class, 'detailDonasi'])->name('donatur.detail-donasi');
    Route::get('/create-donasi', [DonaturController::class, 'createDonasi'])->name('donatur.create-donasi');
    Route::post('/register', [DonaturController::class, 'register'])->name('donatur.register');
    Route::get('/register', [DonaturController::class, 'register'])->name('donatur.register');
});

// NGO
Route::prefix('ngo')->group(function () {
    Route::get('/login', [NgoController::class, 'login'])->name('ngo.login');
    Route::get('/dashboard', [NgoController::class, 'dashboard'])->name('ngo.dashboard');
    Route::get('/donasi', [NgoController::class, 'donasi'])->name('ngo.donasi');
    Route::get('/profile', [NgoController::class, 'profile'])->name('ngo.profile');
    Route::get('/detail-donasi', [NgoController::class, 'detailDonasi'])->name('ngo.detail-donasi');
    Route::get('/register', [NgoController::class, 'register'])->name('ngo.register');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/donasi', [AdminController::class, 'donasi'])->name('admin.donasi');
    Route::get('/detail-donasi', [AdminController::class, 'detailDonasi'])->name('admin.detail-donasi');
    Route::get('/donatur', [AdminController::class, 'donatur'])->name('admin.donatur');
    Route::get('/detail-donatur', [AdminController::class, 'detailDonatur'])->name('admin.detail-donatur');
    Route::get('/ngo', [AdminController::class, 'ngo'])->name('admin.ngo');
    Route::get('/detail-ngo', [AdminController::class, 'detailNgo'])->name('admin.detail-ngo');
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.admins');
    Route::get('/detail-admin', [AdminController::class, 'detailAdmin'])->name('admin.detail-admin');
    Route::get('/kota', [AdminController::class, 'kota'])->name('admin.kota');
    Route::get('/detail-kota', [AdminController::class, 'detailKota'])->name('admin.detail-kota');
    Route::get('/create-kota', [AdminController::class, 'createKota'])->name('admin.create-kota');
    Route::get('/jenis', [AdminController::class, 'jenis'])->name('admin.jenis');
    Route::get('/detail-jenis', [AdminController::class, 'detailJenis'])->name('admin.detail-jenis');
    Route::get('/create-jenis', [AdminController::class, 'createJenis'])->name('admin.create-jenis');
    Route::get('/kategori', [AdminController::class, 'kategori'])->name('admin.kategori');
    Route::get('/detail-kategori', [AdminController::class, 'detailKategori'])->name('admin.detail-kategori');
    Route::get('/create-kategori', [AdminController::class, 'createKategori'])->name('admin.create-kategori');
    Route::get('/satuan', [AdminController::class, 'satuan'])->name('admin.satuan');
    Route::get('/detail-satuan', [AdminController::class, 'detailSatuan'])->name('admin.detail-satuan');
    Route::get('/create-satuan', [AdminController::class, 'createSatuan'])->name('admin.create-satuan');
    Route::get('/status-donasi', [AdminController::class, 'statusDonasi'])->name('admin.status-donasi');
    Route::get('/detail-status-donasi', [AdminController::class, 'detailStatusDonasi'])->name('admin.detail-status-donasi');
    Route::get('/create-status-donasi', [AdminController::class, 'createStatusDonasi'])->name('admin.create-status-donasi');
});

// Route::get('/tes', [Test::class, 'tesData']);
