<?php

use App\Http\Controllers\Admin\Factories\Inventory\Products\CategoryController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductColorController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductImageController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductSizeController;
use App\Http\Controllers\Admin\Factories\Inventory\RawMaterials\RawMaterialController;
use App\Http\Controllers\Admin\Factories\ProductionScheduling\ScheduleController;
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

Route::middleware('jwt.verify', 'FactoryAdmin', 'CompanyPlan')->group(function () {
    ////////////////////////////////////////////////////////////////////////////////////////////

    // Schedule
    Route::prefix('schedule/factoryAdmin')->group(function () {

        Route::patch('/{id}', [ScheduleController::class, 'update']);
        Route::get('/{id}', [ScheduleController::class, 'show']);
        Route::get('/factory_id/{id}', [ScheduleController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////
    // Route::get('/{id}', [CategoryController::class, 'show']);

    // Categories
    Route::prefix('categories/factoryAdmin')->group(function () {

        Route::get('/all/factory_id/{id}', [CategoryController::class, 'index']);
        Route::post('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
        Route::post('/factory_id/{id}', [CategoryController::class, 'createMainCategory']);
        Route::get('/search', [CategoryController::class, 'search']);
        Route::get('/factory_id/{id}', [CategoryController::class, 'viewMainCategory']);
    });

    Route::prefix('childCategories/factoryAdmin')->group(function () {

        Route::post('/{id}/factory_id/{factory_id}', [CategoryController::class, 'createChildCategory']);
        Route::get('/{category_id}/factory_id/{id}', [CategoryController::class, 'viewChildCategory']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Product
    Route::prefix('product/factoryAdmin')->group(function () {

        Route::patch('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::post('/category_id/{id}', [ProductController::class, 'store']);
        Route::get('/search', [ProductController::class, 'search']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::get('/category_id/{id}', [ProductController::class, 'index']);
        Route::get('/', [ProductController::class, 'all']);
    });

    // ProductColor
    Route::prefix('productColor/factoryAdmin')->group(function () {

        Route::delete('/{id}', [ProductColorController::class, 'destroy']);
        Route::post('/product/{id}', [ProductColorController::class, 'store']);
        Route::get('/product/{id}', [ProductColorController::class, 'index']);
    });

    // ProductImage
    Route::prefix('productImage/factoryAdmin')->group(function () {

        Route::delete('/{id}', [ProductImageController::class, 'destroy']);
        Route::post('/product/{id}', [ProductImageController::class, 'store']);
        Route::get('/product/{id}', [ProductImageController::class, 'index']);
    });

    // ProductSize
    Route::prefix('productSize/factoryAdmin')->group(function () {

        Route::delete('/{id}', [ProductSizeController::class, 'destroy']);
        Route::post('/product/{id}', [ProductSizeController::class, 'store']);
        Route::get('/product/{id}', [ProductSizeController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////
    // Route::get('/{id}', [RawMaterialController::class, 'show']);

    // inventoryMaterials
    Route::prefix('inventoryMaterials/factoryAdmin')->group(function () {

        Route::patch('/{id}', [RawMaterialController::class, 'update']);
        Route::delete('/{id}', [RawMaterialController::class, 'destroy']);
        Route::post('/supplier_id/{id}/factory_id/{factory_id}', [RawMaterialController::class, 'store']);
        Route::get('/factory_id/{id}', [RawMaterialController::class, 'index']);
        Route::get('/search', [RawMaterialController::class, 'search']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////
});
