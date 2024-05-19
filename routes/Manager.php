<?php

use App\Http\Controllers\Admin\Companies\CompanyController;
use App\Http\Controllers\Admin\Deliveries\DeliveryController;
use App\Http\Controllers\Admin\Deliveries\DeliveryProductController;
use App\Http\Controllers\Admin\Deliveries\DeriverController;
use App\Http\Controllers\Admin\Factories\Factory\FactoryController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\CategoryController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductController;
use App\Http\Controllers\Admin\Factories\Inventory\RawMaterials\RawMaterialController;
use App\Http\Controllers\Admin\Factories\ProductionScheduling\ScheduleController;
use App\Http\Controllers\Admin\Factories\ProductionScheduling\ScheduleImageController;
use App\Http\Controllers\Admin\Retrievals\RetrievalController;
use App\Http\Controllers\Admin\Shops\SalesController;
use App\Http\Controllers\Admin\Shops\ShopController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\Suppliers\SupplierController;
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

Route::middleware('jwt.verify', 'Manager', 'CompanyPlan')->group(function () {
    // Companies
    Route::prefix('companies/manager')->group(function () {
        Route::get('/getOne/{id}', [CompanyController::class, 'show']);
        Route::post('/update/{id}', [CompanyController::class, 'update']);
        Route::post('/create', [CompanyController::class, 'store']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////
    // Route::get('/getOne/{id}', [SupplierController::class, 'show1']);
    // Route::get('/getAll', [SupplierController::class, 'index1']);

    // Suppliers
    Route::prefix('suppliers/manager')->group(function () {
        Route::post('/update/{id}', [SupplierController::class, 'update']);
        Route::delete('/delete/{id}', [SupplierController::class, 'destroy']);
        Route::post('/create/company_id/{id}', [SupplierController::class, 'store']);
        Route::get('/getAll/company_id/{id}', [SupplierController::class, 'index']);
        Route::get('/search', [SupplierController::class, 'search']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Factory
    Route::prefix('factories/manager')->group(function () {
        Route::post('/update/{id}', [FactoryController::class, 'update']);
        Route::delete('/delete/{id}', [FactoryController::class, 'destroy']);
        Route::post('/create/company_id/{id}', [FactoryController::class, 'store']);
        Route::get('/getAll/company_id/{id}', [FactoryController::class, 'index']);
        Route::get('/search', [FactoryController::class, 'search']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // AddAdmin
    Route::post('/addAdmin/manager/company_id/{company_id}', [SuperAdminController::class, 'addAdmin']);


    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Shops

    Route::prefix('shopInfo/manager')->group(function () {

        Route::get('/specificAdmin', [ShopController::class, 'showShopInfoForSpecificAdmin']);
        Route::post('/{id}', [ShopController::class, 'update']);
        Route::delete('/{id}', [ShopController::class, 'destroy']);
        Route::post('/company_id/{company_id}', [ShopController::class, 'store']);
        Route::get('/search', [ShopController::class, 'search']);
        Route::get('/{id}', [ShopController::class, 'show']);
        Route::get('/company_id/{company_id}', [ShopController::class, 'index']);
    });

    // Sales
    Route::prefix('sales/manager')->group(function () {

        Route::get('/search', [SalesController::class, 'search']);
        Route::get('/{id}', [SalesController::class, 'show']);
        Route::get('/shop_id/{id}', [SalesController::class, 'shopHistory']);
        Route::get('/', [SalesController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Product
    Route::prefix('product/manager')->group(function () {

        Route::get('/search', [ProductController::class, 'search']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::get('/category_id/{id}', [ProductController::class, 'index']);
        Route::get('/', [ProductController::class, 'all']);
    });


    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////
    // Route::get('/{id}', [RawMaterialController::class, 'show']);

    // inventoryMaterials
    Route::prefix('inventoryMaterials/manager')->group(function () {

        Route::get('/factory_id/{id}', [RawMaterialController::class, 'index']);
        Route::get('/search', [RawMaterialController::class, 'search']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////
    // Route::get('/{id}', [CategoryController::class, 'show']);

    // Categories
    Route::prefix('categories/manager')->group(function () {

        Route::get('/all/factory_id/{id}', [CategoryController::class, 'index']);
        Route::get('/search', [CategoryController::class, 'search']);
    });

    Route::prefix('childCategories/manager')->group(function () {

        Route::get('/{category_id}/factory_id/{id}', [CategoryController::class, 'viewChildCategory']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Schedule
    Route::prefix('schedule/manager')->group(function () {

        Route::patch('/{id}', [ScheduleController::class, 'update']);
        Route::delete('/{id}', [ScheduleController::class, 'destroy']);
        Route::post('/factory_id/{id}', [ScheduleController::class, 'store']);
        Route::get('/{id}', [ScheduleController::class, 'show']);
        Route::get('/factory_id/{id}', [ScheduleController::class, 'index']);
    });

    // ScheduleImage
    Route::prefix('scheduleImage/manager')->group(function () {

        Route::delete('/{id}', [ScheduleImageController::class, 'destroy']);
        Route::post('/{id}', [ScheduleImageController::class, 'store']);
        Route::get('/{id}', [ScheduleImageController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Retrieval
    Route::prefix('retrieval/manager')->group(function () {

        Route::post('/updateStatus/{id}', [RetrievalController::class, 'updateStatus']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Delivery
    Route::prefix('delivery/manager')->group(function () {

        Route::post('/deriver_id/{deriver_id}/company_id/{company_id}', [DeliveryController::class, 'store']);
        Route::post('/{id}/deriver_id/{deriver_id}', [DeliveryController::class, 'updateDeriver']);
        Route::post('/{id}', [DeliveryController::class, 'updateDestination']);
        Route::get('/{id}', [DeliveryController::class, 'show']);
        Route::get('/destination/{destination}', [DeliveryController::class, 'getDeliveryForSpecificDestination']);
        Route::get('/company_id/{company_id}', [DeliveryController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // DeliveryProduct
    Route::prefix('deliveryProduct/manager')->group(function () {

        Route::post('/delivery_id/{delivery_id}/product_id/{product_id}', [DeliveryProductController::class, 'store']);
        Route::post('/product_id/{product_id}', [DeliveryProductController::class, 'updateProducts']);
        Route::delete('/{id}', [DeliveryProductController::class, 'destroy']);
        Route::get('/{id}', [DeliveryProductController::class, 'show']);
        Route::get('/', [DeliveryProductController::class, 'index']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////

    // Deriver
    Route::prefix('deriver/manager')->group(function () {

        Route::post('/{id}', [DeriverController::class, 'update']);
        Route::delete('/{id}', [DeriverController::class, 'destroy']);
        Route::get('/{id}', [DeriverController::class, 'show']);
        Route::post('/company_id/{company_id}', [DeriverController::class, 'store']);
        Route::get('/company_id/{company_id}', [DeriverController::class, 'index']);
        Route::get('/search', [DeriverController::class, 'search']);
    });

    ////////////////////////////////////////////////////////////////////////////////////////////

});
