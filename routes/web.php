<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailBarangKeluarController;
use App\Http\Controllers\DetailBarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SupplierController;
use App\Models\BarangKeluar;
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

Route::get('/', function () {
    return view('layouts.master1');
});
// Route::get('/x', function () {
//     return view('jenis_barang.index');
// });

Route::resource('jenis_barangs', JenisBarangController::class);
Route::resource('barangs', BarangController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('customers', CustomerController::class);
Route::resource('barang_masuks', BarangMasukController::class);
Route::resource('barang_keluars', BarangKeluarController::class);
Route::resource('detail_barang_masuks', DetailBarangMasukController::class);
Route::resource('detail_barang_keluars', DetailBarangKeluarController::class);
Route::get('/users/{id}', "BarangKeluarController@cetak");
