<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockTransactionController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

// Data Barang
Route::resource('items', ItemController::class);

// Kategori
Route::resource('categories', CategoryController::class);

// Barang Masuk
Route::post('/transactions/in', [StockTransactionController::class, 'storeIn'])
    ->name('transactions.in');

// Barang Keluar
Route::post('/transactions/out', [StockTransactionController::class, 'storeOut'])
    ->name('transactions.out');

// Riwayat Transaksi
Route::get('/transactions', [StockTransactionController::class, 'index'])
    ->name('transactions.index');