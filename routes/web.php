<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailBarangKeluarController;
use App\Http\Controllers\DetailBarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SupplierController;

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
    //return view('layouts.master1');
    return redirect()->route('login');
});

// Route::get("/logout", [AuthenticatedSessionController::class, 'lohoutSession'])-?
// Route::get('/dashboard', function () {
    // return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('suppliers/dashboard', [SupplierController::class, 'countData'])->name('suppliers.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

;
Route::resource('jenis_barangs', JenisBarangController::class);
Route::resource('barangs', BarangController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('customers', CustomerController::class);
Route::resource('barang_masuks', BarangMasukController::class);
Route::resource('barang_keluars', BarangKeluarController::class);
Route::resource('detail_barang_masuks', DetailBarangMasukController::class);
Route::resource('detail_barang_keluars', DetailBarangKeluarController::class);

Route::get('/cetak/{barang_keluar}', [BarangKeluarController::class, 'cetak'])->name('cetak');

require __DIR__.'/auth.php';
