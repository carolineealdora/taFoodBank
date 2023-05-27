<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgoController;
use App\Http\Controllers\UserController;
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
Route::post('/register', [DonaturController::class, 'register'])->name('donatur.register');

Route::post('donatur/edit/{id}', [DonaturController::class, 'editDonasi'])->name('donatur.editDonasi');

Route::get('donatur/donasi', [DonaturController::class, 'getList'])->name('donatur.getList');
Route::get('donatur/donasi/{id}', [DonaturController::class, 'getDetail'])->name('donatur.detailDonasi');
Route::post('donatur/edit/{id}', [DonaturController::class, 'editDonasi'])->name('donatur.editDonasi'); 
Route::get('donatur/donasi/{id}', [DonaturController::class, 'getList'])->name('donatur.getList');
Route::delete('donasi/delete/{id}', [DonaturController::class, 'deleteDonasi'])->name('donatur.deleteDonasi');
Route::delete('admin/delete/{id}', [DonaturController::class, 'deleteDonasi'])->name('admin.deleteDonasi');
Route::post('donatur/store', [DonaturController::class, 'storeDonasi'])->name('donatur.storeDonasi');





Route::post('donatur/store', [DonaturController::class, 'storeDonasi'])->name('donatur.storeDonasi');


Route::post('user/edit', [UserController::class, 'edit'])->name('user.edit');



//NGO
Route::post('ngo/register', [NgoController::class, 'register'])->name('ngo.register');
Route::get('ngo/list-donasi', [NgoController::class, 'listDonasi'])->name('ngo.listDonasi');
Route::get('ngo/list-donasi/{id}', [NgoController::class, 'showDonasi'])->name('ngo.detailDonasi');
Route::put('ngo/donasi-approve/{id}', [NgoController::class, 'donasiApprove'])->name('ngo.donasiApprove');
Route::put('ngo/donasi-cancel/{id}', [NgoController::class, 'donasiCancel'])->name('ngo.donasiCancel');
Route::get('ngo/data-pickup/{id}', [NgoController::class, 'getDataPickup'])->name('ngo.dataPickup');
