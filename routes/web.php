<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator\ProductController;

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

Route::get('/', fn() => redirect()->route('product'));

//Product Route
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product');
    Route::get('product-data', [ProductController::class, 'data'])->name('product.data');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('create', [ProductController::class, 'store'])->name('product.store');
    Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

