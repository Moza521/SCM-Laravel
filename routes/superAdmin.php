<?php

use App\Http\Controllers\Admin\Companies\CompanyController;
use App\Http\Controllers\Admin\Deliveries\DeliveryController;
use App\Http\Controllers\Admin\Deliveries\DeriverController;
use App\Http\Controllers\Admin\Deliveries\DeliveryProductController;
use App\Http\Controllers\Admin\Factories\Factory\FactoryController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\CategoryController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductColorController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductImageController;
use App\Http\Controllers\Admin\Factories\Inventory\Products\ProductSizeController;
use App\Http\Controllers\Admin\Factories\Inventory\RawMaterials\RawMaterialController;
use App\Http\Controllers\Admin\Factories\ProductionScheduling\ScheduleController;
use App\Http\Controllers\Admin\Factories\ProductionScheduling\ScheduleImageController;
use App\Http\Controllers\Admin\Retrievals\RetrievalController;
use App\Http\Controllers\Admin\Shops\SalesController;
use App\Http\Controllers\Admin\Shops\ShopController;
use App\Http\Controllers\Admin\Subscription\SubscriptionPlanController;
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

////////////////////////////////////////////////////////////////////////////////////////////

// Companies
Route::prefix('subscriptionPlans')->group(function () {
    Route::get('/getOne/{id}', [SubscriptionPlanController::class, 'show']);
    Route::post('/update/{id}', [SubscriptionPlanController::class, 'update']);
    Route::delete('/delete/{id}', [SubscriptionPlanController::class, 'destroy']);
    Route::post('/create', [SubscriptionPlanController::class, 'store']);
    Route::get('/getAll', [SubscriptionPlanController::class, 'index']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Companies
Route::prefix('companies')->group(function () {
    Route::get('/getOne/{id}', [CompanyController::class, 'show']);
    Route::post('/update/{id}/subscriptionPlan/{subscriptionPlan_id}', [CompanyController::class, 'update']);
    Route::delete('/delete/{id}', [CompanyController::class, 'destroy']);
    Route::post('/create/subscriptionPlan/{subscriptionPlan_id}', [CompanyController::class, 'store']);
    Route::get('/getAll', [CompanyController::class, 'index']);
    Route::get('/search', [CompanyController::class, 'search']);
    Route::get('/subscriptionRenewal/{id}', [CompanyController::class, 'subscriptionRenewal']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
// Route::get('/getOne/{id}', [SupplierController::class, 'show1']);
// Route::get('/getAll', [SupplierController::class, 'index1']);

// Suppliers
Route::prefix('suppliers')->group(function () {
    Route::post('/update/{id}', [SupplierController::class, 'update']);
    Route::delete('/delete/{id}', [SupplierController::class, 'destroy']);
    Route::post('/create/company_id/{id}', [SupplierController::class, 'store']);
    Route::get('/getAll/company_id/{id}', [SupplierController::class, 'index']);
    Route::get('/search', [SupplierController::class, 'search']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Factory
Route::prefix('factories')->group(function () {
    Route::post('/update/{id}', [FactoryController::class, 'update']);
    Route::delete('/delete/{id}', [FactoryController::class, 'destroy']);
    Route::post('/create/company_id/{id}', [FactoryController::class, 'store']);
    Route::get('/getAll/company_id/{id}', [FactoryController::class, 'index']);
    Route::get('/search', [FactoryController::class, 'search']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// AddAdmin
Route::post('/addAdmin/company_id/{company_id}', [SuperAdminController::class, 'addAdmin']);

// All Users
Route::get('/allUsers', [SuperAdminController::class, 'allUsers']);

// Search For User
Route::get('/search', [SuperAdminController::class, 'search']);

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Shops

Route::prefix('shopInfo')->group(function () {

    Route::get('/specificAdmin', [ShopController::class, 'showShopInfoForSpecificAdmin']);
    Route::post('/superAdmin/{id}', [ShopController::class, 'update']);
    Route::delete('/superAdmin/{id}', [ShopController::class, 'destroy']);
    Route::post('/company_id/{company_id}', [ShopController::class, 'store']);
    Route::get('/search', [ShopController::class, 'search']);
    Route::get('/{id}', [ShopController::class, 'show']);
    Route::get('/company_id/{company_id}', [ShopController::class, 'index']);
});

// Sales
Route::prefix('sales')->group(function () {

    Route::get('/search', [SalesController::class, 'search']);
    Route::patch('/{id}', [SalesController::class, 'update']);
    Route::delete('/{id}', [SalesController::class, 'destroy']);
    Route::post('/', [SalesController::class, 'store']);
    Route::get('/{id}', [SalesController::class, 'show']);
    Route::get('/shop_id/{id}', [SalesController::class, 'shopHistory']);
    Route::get('/', [SalesController::class, 'index']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Product
Route::prefix('product')->group(function () {

    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
    Route::post('/category_id/{id}', [ProductController::class, 'store']);
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::get('/category_id/{id}', [ProductController::class, 'index']);
    Route::get('/', [ProductController::class, 'all']);
});

// ProductColor
Route::prefix('productColor')->group(function () {

    Route::delete('/{id}', [ProductColorController::class, 'destroy']);
    Route::post('/product/{id}', [ProductColorController::class, 'store']);
    Route::get('/product/{id}', [ProductColorController::class, 'index']);
});

// ProductImage
Route::prefix('productImage')->group(function () {

    Route::delete('/{id}', [ProductImageController::class, 'destroy']);
    Route::post('/product/{id}', [ProductImageController::class, 'store']);
    Route::get('/product/{id}', [ProductImageController::class, 'index']);
});

// ProductSize
Route::prefix('productSize')->group(function () {

    Route::delete('/{id}', [ProductSizeController::class, 'destroy']);
    Route::post('/product/{id}', [ProductSizeController::class, 'store']);
    Route::get('/product/{id}', [ProductSizeController::class, 'index']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
// Route::get('/{id}', [RawMaterialController::class, 'show']);

// inventoryMaterials
Route::prefix('inventoryMaterials/superAdmin')->group(function () {

    Route::patch('/{id}', [RawMaterialController::class, 'update']);
    Route::delete('/{id}', [RawMaterialController::class, 'destroy']);
    Route::post('/supplier_id/{id}/factory_id/{factory_id}', [RawMaterialController::class, 'store']);
    Route::get('/factory_id/{id}', [RawMaterialController::class, 'index']);
    Route::get('/search', [RawMaterialController::class, 'search']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
// Route::get('/{id}', [CategoryController::class, 'show']);

// Categories
Route::prefix('categories')->group(function () {

    Route::get('/all/factory_id/{id}', [CategoryController::class, 'index']);
    Route::post('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
    Route::post('/factory_id/{id}', [CategoryController::class, 'createMainCategory']);
    Route::get('/search', [CategoryController::class, 'search']);
    Route::get('/factory_id/{id}', [CategoryController::class, 'viewMainCategory']);
});

Route::prefix('childCategories')->group(function () {

    Route::post('/{id}/factory_id/{factory_id}', [CategoryController::class, 'createChildCategory']);
    Route::get('/{category_id}/factory_id/{id}', [CategoryController::class, 'viewChildCategory']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Schedule
Route::prefix('schedule')->group(function () {

    Route::patch('/{id}', [ScheduleController::class, 'update']);
    Route::delete('/{id}', [ScheduleController::class, 'destroy']);
    Route::post('/factory_id/{id}', [ScheduleController::class, 'store']);
    Route::get('/{id}', [ScheduleController::class, 'show']);
    Route::get('/factory_id/{id}', [ScheduleController::class, 'index']);
});

// ScheduleImage
Route::prefix('scheduleImage')->group(function () {

    Route::delete('/{id}', [ScheduleImageController::class, 'destroy']);
    Route::post('/{id}', [ScheduleImageController::class, 'store']);
    Route::get('/{id}', [ScheduleImageController::class, 'index']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Retrieval
Route::prefix('retrieval')->group(function () {

    Route::post('/{product_id}/company_id/{id}', [RetrievalController::class, 'store']);
    Route::post('/{id}/product_id/{product_id}', [RetrievalController::class, 'updateProductId']);
    Route::post('/updateStatus/{id}', [RetrievalController::class, 'updateStatus']);
    Route::delete('/{id}', [RetrievalController::class, 'destroy']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Delivery
Route::prefix('delivery')->group(function () {

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
Route::prefix('deliveryProduct')->group(function () {

    Route::post('/delivery_id/{delivery_id}/product_id/{product_id}', [DeliveryProductController::class, 'store']);
    Route::post('/product_id/{product_id}', [DeliveryProductController::class, 'updateProducts']);
    Route::delete('/{id}', [DeliveryProductController::class, 'destroy']);
    Route::get('/{id}', [DeliveryProductController::class, 'show']);
    Route::get('/', [DeliveryProductController::class, 'index']);
});

////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////

// Deriver
Route::prefix('deriver')->group(function () {

    Route::post('/{id}', [DeriverController::class, 'update']);
    Route::delete('/{id}', [DeriverController::class, 'destroy']);
    Route::get('/{id}', [DeriverController::class, 'show']);
    Route::post('/company_id/{company_id}', [DeriverController::class, 'store']);
    Route::get('/company_id/{company_id}', [DeriverController::class, 'index']);
    Route::get('/search', [DeriverController::class, 'search']);
});

////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware('jwt.verify', 'SuperAdmin')->group(function () {
});
