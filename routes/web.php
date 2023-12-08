<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductContorller;
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

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboards.index');
    })->name('dashboard');

    Route::get('/buku-besar', function () {
        return view('admin.data-books.index');
    })->name('data-books');

    Route::get('/transaksi', function () {
        return view('admin.transactions.index');
    })->name('transactions');

    Route::controller(CashierController::class)->prefix('cashier')->group(function () {
        Route::get('/', 'index')                    ->name('cashier');
        Route::post('/', 'transaction')             ->name('transaction');
    });

    Route::controller(CustomerController::class)->prefix('customers')->group(function () {
        Route::get('/', 'index')                    ->name('customers');
        Route::post('/', 'store')                   ->name('create-customer');
        Route::get('{customer}/edit', 'edit')       ->name('edit-customer');
        Route::patch('{customer}', 'update')        ->name('update-customer');
        Route::delete('{customer}', 'destroy')      ->name('delete-customer');
        Route::get('/find-all', 'findAllCustomer')  ->name('findAllCustomer');
    });
    
    Route::controller(ProductContorller::class)->prefix('product')->group(function () {
        Route::get('/', 'index')                    ->name('products');
        Route::post('/', 'store')                   ->name('create-product');
        Route::get('{product}/edit', 'edit')        ->name('edit-product');
        Route::patch('{product}', 'update')         ->name('update-product');
        Route::delete('{product}', 'destroy')       ->name('delete-product');
        Route::get('/find-all', 'findAllProduct')   ->name('findAllProduct');
    });
    
    Route::get('/stok-barang', function () {
        return view('admin.stocks.index');
    })->name('stocks');

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
});
