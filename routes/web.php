<?php

use App\Http\Controllers\AuthenticationController;
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


Route::middleware([])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboards.index');
    })->name('dashboard');

    Route::get('/kasir', function () {
        return view('admin.cashier.index');
    })->name('cashier');

    Route::get('/buku-besar', function () {
        return view('admin.data-books.index');
    })->name('data-books');

    Route::get('/transaksi', function () {
        return view('admin.transactions.index');
    })->name('transactions');

    Route::get('/pelanggan', function () {
        return view('admin.customers.index');
    })->name('customers');

    Route::get('/produk', function () {
        return view('admin.products.index');
    })->name('products');

    Route::get('/stok-barang', function () {
        return view('admin.stocks.index');
    })->name('stocks');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
});
