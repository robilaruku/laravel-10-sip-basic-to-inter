<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
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
    return redirect()->route('admin.');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('product', ProductController::class);
    Route::get('trx/create', [TransactionController::class, 'create'])->name('trx.create');
    Route::post('trx/import', [TransactionController::class, 'import'])->name('trx.import');
    Route::get('trx', [TransactionController::class, 'index'])->name('trx.index');
    Route::get('trx/{transaction}', [TransactionController::class, 'show'])->name('trx.show');
    Route::put('trx/{transaction}', [TransactionController::class, 'update'])->name('trx.update');

    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});






