<?php

use App\Http\Controllers\DonaturController;
use App\Http\Controllers\NgoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('ngo/register', [NgoController::class, 'register'])->name('ngo.register');
Route::post('donatur/edit/{id}', [DonaturController::class, 'editDonasi'])->name('donatur.editDonasi');

Route::get('donatur/donasi/{id}', [DonaturController::class, 'getList'])->name('donatur.getList');
Route::delete('donasi/delete/{id}', [DonaturController::class, 'deleteDonasi'])->name('donatur.deleteDonasi');


Route::delete('admin/delete/{id}', [DonaturController::class, 'deleteDonasi'])->name('admin.deleteDonasi');


// Route::get('ngo/donasi', [NgoController::class, 'listDonasi'])->name('ngo.listDonasi');
Route::get('ngo/list-donasi', [NgoController::class, 'listDonasi'])->name('ngo.listDonasi');

Route::post('donatur/store', [DonaturController::class, 'storeDonasi'])->name('donatur.storeDonasi');
