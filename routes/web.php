<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'index'])->name("login")->middleware("guest");
Route::post('/auth', [AuthController::class, 'Auth'])->middleware("guest");

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::resources([
        '/dashboard' => Dashboard::class,
        '/product' => ProductController::class,
        '/category' => CategoryController::class,
        '/setting' => SettingController::class,
        '/transaction' => TransactionController::class,
        '/laporan' => LaporanController::class,
    ]);
    Route::post('storeUser', [ProductController::class, 'storeUser'])->name("user.add");
    Route::get('cek', [ProductController::class, 'cekHarga'])->name("product.cek");
    Route::get('produk', [ProductController::class, 'validasi'])->name("product.validasi");

    // Transaksi
    Route::get('product/{product}', [ProductController::class, 'destroy']);
    Route::get('get-product', [TransactionController::class, 'getProduct'])->name('get.product');
    Route::get('delete-product', [TransactionController::class, 'delete'])->name('delete.product');
    Route::get('update-product', [TransactionController::class, 'updateProduct'])->name('update.product');
    Route::get('selesai-product', [TransactionController::class, 'selesaiProduct'])->name('selesai.product');
    Route::get('cetak-transaksi', [TransactionController::class, 'cetakTransaksi'])->name('cetak.transaksi');

    // Laporan
    Route::get('laporan-data', [LaporanController::class, 'getLaporan'])->name('data.laporan');
    Route::get('cetak-laporan/{$id}', [LaporanController::class, 'cetakLaporan'])->name('cetak.laporan');
});
