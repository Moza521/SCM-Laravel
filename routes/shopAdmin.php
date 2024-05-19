<?php

use App\Http\Controllers\Admin\Retrievals\RetrievalController;
use App\Http\Controllers\Admin\Shops\SalesController;
use App\Http\Controllers\Admin\Shops\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('jwt.verify', 'ShopAdmin', 'CompanyPlan')->group(function () {
    ////////////////////////////////////////////////////////////////////////////////////////////

    // Retrieval
    Route::prefix('retrieval/shopAdmin')->group(function () {

        Route::post('/{product_id}/company_id/{id}', [RetrievalController::class, 'store']);
        Route::post('/{id}/product_id/{product_id}', [RetrievalController::class, 'updateProductId']);
        Route::delete('/{id}', [RetrievalController::class, 'destroy']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Shops

    Route::prefix('shopInfo/shopAdmin')->group(function () {

        Route::get('/specificAdmin', [ShopController::class, 'showShopInfoForSpecificAdmin']);
    });

    // Sales
    Route::prefix('sales/shopAdmin')->group(function () {

        Route::get('/search', [SalesController::class, 'search']);
        Route::patch('/{id}', [SalesController::class, 'update']);
        Route::delete('/{id}', [SalesController::class, 'destroy']);
        Route::post('/', [SalesController::class, 'store']);
        Route::get('/{id}', [SalesController::class, 'show']);
        Route::get('/shop_id/{id}', [SalesController::class, 'shopHistory']);
        Route::get('/', [SalesController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////
});
