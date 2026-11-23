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

// Transaksi
Route::get('/transactions', [StockTransactionController::class, 'index'])
    ->name('transactions.index');

Route::get('/transactions/create', [StockTransactionController::class, 'create'])
    ->name('transactions.create');

Route::post('/transactions', [StockTransactionController::class, 'store'])
    ->name('transactions.store');