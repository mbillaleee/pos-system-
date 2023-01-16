<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\unitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\AccountTransectionController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\ShopController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/users/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::post('update/{id}/profile', [App\Http\Controllers\HomeController::class, 'profile_update'])->name('profile.update');
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('/takealot/product', [App\Http\Controllers\TakealotController::class, 'index'])->name('takealot.product');
    Route::get('/takealot/report', [App\Http\Controllers\TakealotController::class, 'report'])->name('takealot.report');
    Route::get('/takealot/sync', [App\Http\Controllers\TakealotController::class, 'product_sync'])->name('takealot.sync');
    Route::post('update-takealot', [App\Http\Controllers\TakealotController::class, 'update'])->name('takealot.update');
    Route::post('edit-takealot', [App\Http\Controllers\TakealotController::class, 'edit'])->name('takealot.edit');
    Route::post('delete-takealot', [App\Http\Controllers\TakealotController::class, 'destroy'])->name('takealot.destroy');
    Route::post('update-api-takealot', [App\Http\Controllers\TakealotController::class, 'api_update'])->name('takealot.api.update');
    Route::post('takealot/import', [App\Http\Controllers\TakealotController::class, 'import'])->name('takealot.import');

    Route::get('/takealot/sales', [App\Http\Controllers\TakealotSaleController::class, 'index'])->name('takealot.sales');
    Route::get('/takealot/sync/sales', [App\Http\Controllers\TakealotSaleController::class, 'sales_sync'])->name('takealot.sales.sync');
    Route::post('takealot/sales/import', [App\Http\Controllers\TakealotSaleController::class, 'import'])->name('takealotsales.import');
    Route::get('/takealot/update/quantity', [App\Http\Controllers\TakealotController::class, 'update_qty'])->name('takealot.quantity');
    Route::get('/takealot/update/qty', [App\Http\Controllers\TakealotController::class, 'update_qty_up'])->name('takealot.qty');

    Route::get('/takealot/profit/calculation', [App\Http\Controllers\TakealotController::class, 'profit_calculation'])->name('takealot.profit.calculation');

    Route::get('/mypos/product', [App\Http\Controllers\MyPosController::class, 'index'])->name('mypos.product');
    Route::get('/mypos/sync', [App\Http\Controllers\MyPosController::class, 'product_sync'])->name('mypos.sync');
    Route::post('update-api-mypos', [App\Http\Controllers\MyPosController::class, 'api_update'])->name('mypos.api.update');
    Route::post('update-mypos', [App\Http\Controllers\MyPosController::class, 'update'])->name('mypos.update');
    Route::post('edit-mypos', [App\Http\Controllers\MyPosController::class, 'edit'])->name('mypos.edit');
    Route::post('mypos/import', [App\Http\Controllers\MyPosController::class, 'import'])->name('mypos.import');

    Route::get('/posminprice', [App\Http\Controllers\PosMinPriceController::class, 'index'])->name('posminprice');
    Route::get('/posminprice/sync', [App\Http\Controllers\PosMinPriceController::class, 'product_sync'])->name('posminprice.sync');
    Route::post('update-posminprice', [App\Http\Controllers\PosMinPriceController::class, 'update'])->name('posminprice.update');
    Route::post('edit-posminprice', [App\Http\Controllers\PosMinPriceController::class, 'edit'])->name('posminprice.edit');

    Route::get('/shopify/product', [App\Http\Controllers\ShopifyController::class, 'index'])->name('shopify.product');
    Route::get('/shopify/sync', [App\Http\Controllers\ShopifyController::class, 'product_sync'])->name('shopify.sync');
    Route::post('update-shopify', [App\Http\Controllers\ShopifyController::class, 'update'])->name('shopify.update');
    Route::post('edit-shopify', [App\Http\Controllers\ShopifyController::class, 'edit'])->name('shopify.edit');
    Route::post('delete-shopify', [App\Http\Controllers\ShopifyController::class, 'destroy'])->name('shopify.destroy');
    Route::post('update-api-shopify', [App\Http\Controllers\ShopifyController::class, 'api_update'])->name('shopify.api.update');
    Route::post('shopify/import', [App\Http\Controllers\ShopifyController::class, 'import'])->name('shopify.import');
    Route::get('/shopify/update/quantity', [App\Http\Controllers\ShopifyController::class, 'update_qty'])->name('shopify.quantity');
    Route::get('/shopify/update/qty', [App\Http\Controllers\ShopifyController::class, 'update_qty_up'])->name('shopify.qty');
    Route::get('/shopify/sales', [App\Http\Controllers\ShopifySaleController::class, 'index'])->name('shopify.sales');
    Route::get('/shopify/sync/sales', [App\Http\Controllers\ShopifySaleController::class, 'sales_sync'])->name('shopify.sales.sync');
    Route::post('shopify/sales/import', [App\Http\Controllers\ShopifySaleController::class, 'import'])->name('shopify.sales.import');


    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.list');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/suppliers/edit/{supplier}', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::post('/suppliers/update/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/destroy/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');



    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.lists');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customers/update/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/destroy/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');



    Route::get('/brand', [BrandController::class, 'index'])->name('brand.lists');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{brand}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/destroy/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');


    Route::get('/unit', [unitController::class, 'index'])->name('unit.lists');
    Route::get('/unit/create', [unitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [unitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{unit}', [unitController::class, 'edit'])->name('unit.edit');
    Route::post('/unit/update/{unit}', [unitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/destroy/{unit}', [unitController::class, 'destroy'])->name('unit.destroy');



    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');




    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/product/getsubcategory', [ProductController::class, 'getsubcategory'])->name('product.getsubcategory');



    Route::get('/purchase', [PurchasesController::class, 'index'])->name('purchase.index'); //purchase report here
    Route::get('/purchase/create', [PurchasesController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/store', [PurchasesController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/productPrice', [PurchasesController::class, 'productPrice'])->name('purchase.price');



    Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');
    Route::get('/sale/create', [SaleController::class, 'create'])->name('sale.create');
    Route::post('/sale/store', [SaleController::class, 'store'])->name('sale.store');
    Route::get('/sale/productPrice', [SaleController::class, 'productPrice'])->name('sale.price');


    Route::get('/chart_of_account', [ChartOfAccountController::class, 'index'])->name('chart_of_account.index');
    Route::post('/chart_of_account/store', [ChartOfAccountController::class, 'store'])->name('chart_of_account.store');
    Route::post('chart-of-account', [ChartOfAccountController::class, 'edit'])->name('chart_of_account.edit');
    Route::post('chart-of-account/update', [ChartOfAccountController::class, 'update'])->name('chart_of_account.update');
    


    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::get('/expense/edit/{expense}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::post('/expense/update/{expense}', [ExpenseController::class, 'update'])->name('expense.update');
    Route::delete('/expense/destroy/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
    Route::post('/expense/getsubcategory', [ExpenseController::class, 'getsubcategory'])->name('expense.getsubcategory');


    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income/store', [IncomeController::class, 'store'])->name('income.store');



    Route::get('/report/purchasereport', [ReportController::class, 'purchasereport'])->name('purchasereport.index'); //purchase report here
    Route::get('/report/salereport', [ReportController::class, 'salereport'])->name('salereport.index'); //sale report here
    Route::get('/report/saleinvoice/{id}', [ReportController::class, 'saleinvoice'])->name('saleinvoice'); //sale report here
    Route::get('/report/purchase-invoice/{id}', [ReportController::class, 'purchase_invoice'])->name('purchase_invoice'); //sale report here
    // Route::get('/report/salereport', [ReportController::class, 'ajax'])->name('salereport.index'); //sale report here


    // Route::get('/report/purchasereport', [ReportController::class, 'getCustomFilter'])->name('purchasereport.index');
    // Route::get('/report/purchasereport', [ReportController::class, 'getCustomFilterData'])->name('purchasereport.index');


    Route::get('/variant', [VariantController::class, 'index'])->name('variant.index');
    Route::get('/variant/create', [VariantController::class, 'create'])->name('variant.create');
    Route::post('/variant/store', [VariantController::class, 'store'])->name('variant.store');
    Route::get('/variant/edit/{id}', [VariantController::class, 'edit'])->name('variant.edit');
    Route::post('/variant/update/{variant}', [VariantController::class, 'update'])->name('variant.update');
    Route::delete('/variant/destroy/{id}', [VariantController::class, 'destroy'])->name('variant.destroy');


    Route::get('/variant/variantAdd', [VariantController::class, 'variantAdd'])->name('variantAdd');


    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::post('/shop/update/{shop}', [ShopController::class, 'update'])->name('shop.update');
    Route::delete('/shop/destroy/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');
});