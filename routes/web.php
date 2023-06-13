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
    Route::get('/show-login', [DonaturController::class, 'showLoginForm'])->name('donatur.showLogin');
    Route::get('/show-register', [DonaturController::class, 'showRegisterForm'])->name('donatur.showRegister');
    Route::get('/login', [DonaturController::class, 'login'])->name('donatur.login');
    Route::post('/register', [DonaturController::class, 'register'])->name('donatur.register');
    Route::get('/dashboard', [DonaturController::class, 'dashboard'])->name('donatur.dashboard');
    Route::get('/donasi', [DonaturController::class, 'getListDonasi'])->name('donatur.donasi');
    Route::get('/profile', [DonaturController::class, 'getProfile'])->name('donatur.profile');
    Route::post('/edit-profile', [DonaturController::class, 'editProfile'])->name('donatur.edit-profile');
    Route::get('/detail-donasi/{id}', [DonaturController::class, 'detailDonasi'])->name('donatur.detail-donasi');
    Route::get('/create-donasi', [DonaturController::class, 'createDonasi'])->name('donatur.create-donasi');
    Route::post('/create-donasi', [DonaturController::class, 'storeDonasi'])->name('donatur.store-donasi');
    Route::post('/add-donasi/{id}', [DonaturController::class, 'tambahDonasiKonsumsi'])->name('donatur.add-donasi');
    Route::post('/edit/{id}', [DonaturController::class, 'editDonasi'])->name('donatur.editDonasi');
    Route::post('/edit-pickup/{id}', [DonaturController::class, 'editPickup'])->name('donatur.editPickup');
    Route::get('/logout', [DonaturController::class, 'logout'])->name('donatur.logout');
    Route::delete('/delete-donasi-konsumsi/{id}', [DonaturController::class, 'deleteDonasiKonsumsi'])->name('donatur.deleteDonasiKonsumsi');
    Route::delete('/delete-donasi/{id}', [DonaturController::class, 'deleteDonasi'])->name('donatur.deleteDonasi');
});

// NGO
Route::prefix('ngo')->group(function () {
    Route::get('/show-login', [NgoController::class, 'showLoginForm'])->name('ngo.showLogin');
    Route::get('/show-register', [NgoController::class, 'showRegisterForm'])->name('ngo.showRegister');
    Route::get('/login', [NgoController::class, 'login'])->name('ngo.login');
    Route::post('/register', [NgoController::class, 'register'])->name('ngo.register');
    Route::get('/dashboard', [NgoController::class, 'dashboard'])->name('ngo.dashboard');
    Route::get('/donasi', [NgoController::class, 'donasi'])->name('ngo.donasi');
    Route::get('/detail-donasi/{id}', [NgoController::class, 'detailDonasi'])->name('ngo.detail-donasi');
    Route::put('/donasi-approve/{id}', [NgoController::class, 'donasiApprove'])->name('ngo.donasiApprove');
    Route::put('/donasi-cancel/{id}', [NgoController::class, 'donasiCancel'])->name('ngo.donasiCancel');
    Route::post('/edit-pickup/{id}', [NgoController::class, 'editPickup'])->name('ngo.editPickup');
    Route::post('/waktu-pickup/{id}', [NgoController::class, 'addTimePickup'])->name('ngo.addTimePickup');
    Route::delete('/delete-pickup/{id}', [NgoController::class, 'deletePickup'])->name('ngo.deletePickup');
    Route::post('/report-donasi/{id}', [NgoController::class, 'reportDonasi'])->name('ngo.reportDonasi');
    Route::get('/profile', [NgoController::class, 'getProfile'])->name('ngo.profile');
    Route::post('/edit-profile', [NgoController::class, 'editProfile'])->name('ngo.edit-profile');
    Route::get('/logout', [NgoController::class, 'logout'])->name('ngo.logout');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/show-login', [AdminController::class, 'showLoginForm'])->name('admin.showLogin');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'getProfile'])->name('admin.profile');
    Route::post('/edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
    Route::get('/donasi', [AdminController::class, 'getListDonasi'])->name('admin.donasi');
    Route::get('/detail-donasi/{id}', [AdminController::class, 'detailDonasi'])->name('admin.detail-donasi');
    Route::delete('/delete-donasi/{id}', [AdminController::class, 'deleteDonasi'])->name('admin.deleteDonasi');
    Route::get('/donatur', [AdminController::class, 'donatur'])->name('admin.donatur');
    Route::get('/detail-donatur/{id}', [AdminController::class, 'detailDonatur'])->name('admin.detail-donatur');
    Route::post('/edit-donatur/{id}', [AdminController::class, 'editDonatur'])->name('admin.edit-donatur');
    Route::delete('/delete-donatur/{id}', [AdminController::class, 'deleteDonatur'])->name('admin.delete-donatur');
    Route::get('/ngo', [AdminController::class, 'getListNgo'])->name('admin.ngo');
    Route::get('/detail-ngo/{id}', [AdminController::class, 'detailNgo'])->name('admin.detail-ngo');
    Route::post('/edit-ngo/{id}', [AdminController::class, 'editNGO'])->name('admin.edit-ngo');
    Route::post('/edit-pic/{id}', [AdminController::class, 'editPIC'])->name('admin.edit-pic');
    Route::put('/ngo-approve/{id}', [AdminController::class, 'approveNGO'])->name('admin.ngo-approve');
    Route::put('/ngo-cancel/{id}', [AdminController::class, 'cancelNGO'])->name('admin.ngo-cancel');
    Route::delete('/delete-ngo/{id}', [AdminController::class, 'deleteNGO'])->name('admin.delete-ngo');
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.admins');
    Route::get('/detail-admin', [AdminController::class, 'detailAdmin'])->name('admin.detail-admin');
    Route::get('/kota', [AdminController::class, 'getListKota'])->name('admin.kota');
    Route::post('/create-kota', [AdminController::class, 'storeKota'])->name('admin.store-kota');
    Route::get('/create-kota', [AdminController::class, 'createKota'])->name('admin.create-kota');
    Route::get('/detail-kota/{id}', [AdminController::class, 'detailKota'])->name('admin.detail-kota');
    Route::post('/edit-kota/{id}', [AdminController::class, 'editKota'])->name('admin.edit-kota');
    Route::delete('/delete-kota/{id}', [AdminController::class, 'deleteKota'])->name('admin.delete-kota');
    Route::get('/kategori', [AdminController::class, 'getListKategori'])->name('admin.kategori');
    Route::get('/detail-kategori/{id}', [AdminController::class, 'detailKategori'])->name('admin.detail-kategori');
    Route::post('/edit-kategori/{id}', [AdminController::class, 'editKategori'])->name('admin.edit-kategori');
    Route::delete('/delete-kategori/{id}', [AdminController::class, 'deleteKategori'])->name('admin.delete-kategori');
    Route::get('/create-kategori', [AdminController::class, 'createKategori'])->name('admin.create-kategori');
    Route::post('/create-kategori', [AdminController::class, 'storeKategori'])->name('admin.store-kategori');
    Route::get('/satuan', [AdminController::class, 'getListSatuan'])->name('admin.satuan');
    Route::get('/detail-satuan/{id}', [AdminController::class, 'detailSatuan'])->name('admin.detail-satuan');
    Route::post('/edit-satuan/{id}', [AdminController::class, 'editSatuan'])->name('admin.edit-satuan');
    Route::post('/create-satuan', [AdminController::class, 'storeSatuan'])->name('admin.store-satuan');
    Route::get('/create-satuan', [AdminController::class, 'createSatuan'])->name('admin.create-satuan');
    Route::delete('/delete-satuan/{id}', [AdminController::class, 'deleteSatuan'])->name('admin.delete-satuan');
    Route::get('/status-donasi', [AdminController::class, 'statusDonasi'])->name('admin.status-donasi');
    Route::get('/detail-status-donasi', [AdminController::class, 'detailStatusDonasi'])->name('admin.detail-status-donasi');
    Route::get('/create-status-donasi', [AdminController::class, 'createStatusDonasi'])->name('admin.create-status-donasi');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

});

// Route::get('/tes', [Test::class, 'tesData']);
