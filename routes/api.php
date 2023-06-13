<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonaturController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//admin-ngo

//admin-donatur
// Route::get('admin/detail-donatur/{id}', [AdminController::class, 'getDonatur'])->name('admin.get-detail-donatur');
// Route::delete('admin/delete-donatur/{id}', [AdminController::class, 'deleteDonatur'])->name('admin.delete-donatur');
// Route::get('admin/donatur', [AdminController::class, 'getListDonatur'])->name('admin.get-list-donatur');

// //admin-donasi
// Route::get('admin/detail-donasi/{id}', [AdminController::class, 'getDonasi'])->name('admin.get-detail-donasi');
// Route::delete('admin/delete-donasi/{id}', [AdminController::class, 'deleteDonasi'])->name('admin.delete-donasi');
// Route::get('admin/donasi', [AdminController::class, 'getListDonasi'])->name('admin.get-list-donasi');


// //admin-kota
// Route::post('admin/store-kota', [AdminController::class, 'storeKota'])->name('admin.store-kota');
// // Route::get('admin/detail-kota/{id}', [AdminController::class, 'getKota'])->name('admin.detail-kota');
// // Route::post('admin/edit-kota/{id}', [AdminController::class, 'editKota'])->name('admin.edit-kota');
// Route::delete('admin/delete-kota/{id}', [AdminController::class, 'deleteKota'])->name('admin.delete-kota');
// Route::get('admin/kota', [AdminController::class, 'getListKota'])->name('admin.get-list-kota');

// //admin-kategori
// Route::post('admin/store-kategori', [AdminController::class, 'storeKategori'])->name('admin.store-kategori');
// // Route::get('admin/detail-kategori/{id}', [AdminController::class, 'getKategori'])->name('admin.detail-kategori');
// Route::post('admin/edit-kategori/{id}', [AdminController::class, 'editKategori'])->name('admin.edit-kategori');
// // Route::delete('admin/delete-kategori/{id}', [AdminController::class, 'deleteKategori'])->name('admin.delete-kategori');
// Route::get('admin/kategori', [AdminController::class, 'getListKategori'])->name('admin.get-list-kategori');

// //admin-satuan
// Route::post('admin/store-satuan', [AdminController::class, 'storeSatuan'])->name('admin.store-satuan');
// Route::get('admin/detail-satuan/{id}', [AdminController::class, 'getSatuan'])->name('admin.detail-satuan');
// Route::post('admin/edit-satuan/{id}', [AdminController::class, 'editSatuan'])->name('admin.edit-satuan');
// Route::delete('admin/delete-satuan/{id}', [AdminController::class, 'deleteSatuan'])->name('admin.delete-satuan');
// Route::get('admin/satuan', [AdminController::class, 'getListSatuan'])->name('admin.get-list-satuan');

// //donatur
// Route::post('/donatur/register', [DonaturController::class, 'register'])->name('donatur.register');
// // Route::post('donatur/edit/{id}', [DonaturController::class, 'editDonasi'])->name('donatur.editDonasi');
// // Route::post('donatur/edit-profile', [DonaturController::class, 'editProfile'])->name('donatur.editProfile');
// // Route::get('donatur/donasi', [DonaturController::class, 'getList'])->name('donatur.donasi');
// Route::get('donatur/donasi/{id}', [DonaturController::class, 'getDetailDonasi'])->name('donatur.detailDonasi');
// // Route::post('donatur/edit/{id}', [DonaturController::class, 'editDonasi'])->name('donatur.editDonasi');
// // Route::get('donatur/donasi/{id}', [DonaturController::class, 'getList'])->name('donatur.getList');
// Route::delete('donasi/delete/{id}', [DonaturController::class, 'deleteDonasi'])->name('donatur.deleteDonasi');
// // Route::post('donatur/store', [DonaturController::class, 'storeDonasi'])->name('donatur.storeDonasi');
// Route::delete('donatur/delete/{id}', [DonaturController::class, 'deleteDonasi'])->name('admin.deleteDonasi');





// Route::post('donatur/store', [DonaturController::class, 'storeDonasi'])->name('donatur.storeDonasi');


// Route::post('user/edit', [UserController::class, 'edit'])->name('user.edit');



// //NGO
// Route::post('ngo/register', [NgoController::class, 'register'])->name('ngo.register');
// // Route::post('ngo/edit-profile', [NgoController::class, 'editProfile'])->name('ngo.editProfile');
// Route::get('ngo/list-donasi', [NgoController::class, 'listDonasi'])->name('ngo.listDonasi');
// Route::get('ngo/list-donasi/{id}', [NgoController::class, 'showDonasi'])->name('ngo.detailDonasi');

// Route::get('ngo/data-pickup/{id}', [NgoController::class, 'getDataPickup'])->name('ngo.dataPickup');
