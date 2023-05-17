<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
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

// Donatur
Route::prefix('donatur')->group(function () {
    Route::get('/login', [DonaturController::class, 'login'])->name('donatur.login');
    Route::get('/dashboard', [DonaturController::class, 'dashboard'])->name('donatur.dashboard');
    Route::get('/donasi', [DonaturController::class, 'donasi'])->name('donatur.donasi');
    Route::get('/profile', [DonaturController::class, 'profile'])->name('donatur.profile');
    Route::get('/detail-donasi', [DonaturController::class, 'detailDonasi'])->name('donatur.detail-donasi');
    Route::get('/create-donasi', [DonaturController::class, 'createDonasi'])->name('donatur.create-donasi');    
    Route::get('/register', [DonaturController::class, 'register'])->name('donatur.register');
});

// Route::get('/donatur-login', function () {
//     return view('donatur/donatur_login');
// })->name('donatur-login');

// Route::get('/donatur-dashboard', function () {
//     return view('donatur/donatur_dashboard');
// })->name('donatur-dashboard');

// Route::get('/donatur-donasi', function () {
//     return view('donatur/donatur_donasi');
// })->name('donatur-donasi');

// Route::get('/donatur-profile', function () {
//     return view('donatur/donatur_profile');
// })->name('donatur-profile');

// Route::get('/donatur-detail-donasi', function () {
//     return view('donatur/donatur_detail_donasi');
// })->name('donatur-detail-donasi');

// Route::get('/donatur-create-donasi', function () {
//     return view('donatur/donatur_create_donasi');
// })->name('donatur-create-donasi');

// Route::get('/donatur-register', function () {
//     return view('donatur/donatur_register');
// })->name('donatur-register');


// NGO
Route::prefix('ngo')->group(function () {
    Route::get('/login', [NgoController::class, 'login'])->name('ngo.login');
    Route::get('/dashboard', [NgoController::class, 'dashboard'])->name('ngo.dashboard');
    Route::get('/donasi', [NgoController::class, 'donasi'])->name('ngo.donasi');
    Route::get('/profile', [NgoController::class, 'profile'])->name('ngo.profile');
    Route::get('/detail-donasi', [NgoController::class, 'detailDonasi'])->name('ngo.detail-donasi');
    Route::get('/register', [NgoController::class, 'register'])->name('ngo.register');
});


// Route::get('/ngo-login', function () {
//     return view('ngo/ngo_login');
// })->name('ngo-login');

// Route::get('/ngo-dashboard', function () {
//     return view('ngo/ngo_dashboard');
// })->name('ngo-dashboard');

// Route::get('/ngo-donasi', function () {
//     return view('ngo/ngo_donasi');
// })->name('ngo-donasi');

// Route::get('/ngo-profile', function () {
//     return view('ngo/ngo_profile');
// })->name('ngo-profile');

// Route::get('/ngo-detail-donasi', function () {
//     return view('ngo/ngo_detail_donasi');
// })->name('ngo-detail-donasi');

// Route::get('/ngo-create-donasi', function () {
//     return view('ngo/ngo_create_donasi');
// })->name('ngo-create-donasi');

// Route::get('/ngo-register', function () {
//     return view('ngo/ngo_register');
// })->name('ngo-register');


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



// Route::get('/admin-login', function () {
//     return view('admin/admin_login');
// })->name('admin-login');

// Route::get('/admin-dashboard', function () {
//     return view('admin/admin_dashboard');
// })->name('admin-dashboard');

// Route::get('/admin-profile', function () {
//     return view('admin/admin_profile');
// })->name('admin-profile');

// Route::get('/admin-donasi', function () {
//     return view('admin/admin_donasi');
// })->name('admin-donasi');

// Route::get('/admin-detail-donasi', function () {
//     return view('admin/admin_detail_donasi');
// })->name('admin-detail-donasi');

// Route::get('/admin-donatur', function () {
//     return view('admin/admin_donatur');
// })->name('admin-donatur');

// Route::get('/admin-detail-donatur', function () {
//     return view('admin/admin_detail_donatur');
// })->name('admin-detail-donatur');

// Route::get('/admin-ngo', function () {
//     return view('admin/admin_ngo');
// })->name('admin-ngo');

// Route::get('/admin-detail-ngo', function () {
//     return view('admin/admin_detail_ngo');
// })->name('admin-detail-ngo');

// Route::get('/admin-admins', function () {
//     return view('admin/admin_admins');
// })->name('admin-admins');

// Route::get('/admin-detail-admin', function () {
//     return view('admin/admin_detail_admin');
// })->name('admin-detail-admin');

// Route::get('/admin-kota', function () {
//     return view('admin/admin_dm_kota');
// })->name('admin-kota');

// Route::get('/admin-detail-kota', function () {
//     return view('admin/admin_dm_detail_kota');
// })->name('admin-detail-kota');

// Route::get('/admin-create-kota', function () {
//     return view('admin/admin_dm_create_kota');
// })->name('admin-create-kota');

// Route::get('/admin-jenis', function () {
//     return view('admin/admin_dm_jenis');
// })->name('admin-jenis');

// Route::get('/admin-detail-jenis', function () {
//     return view('admin/admin_dm_detail_jenis');
// })->name('admin-detail-jenis');

// Route::get('/admin-create-jenis', function () {
//     return view('admin/admin_dm_create_jenis');
// })->name('admin-create-jenis');

// Route::get('/admin-kategori', function () {
//     return view('admin/admin_dm_kategori');
// })->name('admin-kategori');

// Route::get('/admin-detail-kategori', function () {
//     return view('admin/admin_dm_detail_kategori');
// })->name('admin-detail-kategori');

// Route::get('/admin-create-kategori', function () {
//     return view('admin/admin_dm_create_kategori');
// })->name('admin-create-kategori');

// Route::get('/admin-satuan', function () {
//     return view('admin/admin_dm_satuan');
// })->name('admin-satuan');

// Route::get('/admin-detail-satuan', function () {
//     return view('admin/admin_dm_detail_satuan');
// })->name('admin-detail-satuan');

// Route::get('/admin-create-satuan', function () {
//     return view('admin/admin_dm_create_satuan');
// })->name('admin-create-satuan');

// Route::get('/admin-statusDonasi', function () {
//     return view('admin/admin_dm_statusDonasi');
// })->name('admin-statusDonasi');

// Route::get('/admin-detail-statusDonasi', function () {
//     return view('admin/admin_dm_detail_statusDonasi');
// })->name('admin-detail-statusDonasi');

// Route::get('/admin-create-statusDonasi', function () {
//     return view('admin/admin_dm_create_statusDonasi');
// })->name('admin-create-statusDonasi');

// Route::get('/admin-statusNGO', function () {
//     return view('admin/admin_dm_statusNGO');
// })->name('admin-statusNGO');

// Route::get('/admin-detail-statusNGO', function () {
//     return view('admin/admin_dm_detail_statusNGO');
// })->name('admin-detail-statusNGO');

// Route::get('/admin-create-statusNGO', function () {
//     return view('admin/admin_dm_create_statusNGO');
// })->name('admin-create-statusNGO');

//
// Route::get('/tes', [Test::class, 'tesData']);
