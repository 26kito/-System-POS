<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SalesOrderController;

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

Route::prefix('admin')->group( function() {
    Route::get('/', [AdminController::class, 'home']);
    
    Route::prefix('pesanan')->group( function() {
        Route::prefix('sales')->group( function() {
            Route::get('/', [SalesOrderController::class, 'index']);

            Route::post('/insert', [SalesOrderController::class, 'insertAction']);
            Route::get('/report/{id}', [SalesOrderController::class, 'report']);
        });
        Route::prefix('purchase')->group( function() {
            Route::get('/', [PurchaseOrderController::class, 'index']);

            Route::post('/insert', [PurchaseOrderController::class, 'insertAction']);
            Route::get('/report/{id}', [PurchaseOrderController::class, 'report']);
        });
    });

    Route::get('/products', [ProductController::class, 'index']);
});
