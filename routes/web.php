<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
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
use App\Http\Controllers\PriceGroupController;

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

    // Route::get('/users/shop-setting', [App\Http\Controllers\HomeController::class, 'shop_setting'])->name('shop-setting');
    // Route::post('update/{id}/shop-setting', [App\Http\Controllers\HomeController::class, 'shop_setting_update'])->name('shop-setting.update');

    Route::get('/users/shop-setting/{shop}', [App\Http\Controllers\ShopController::class, 'edit'])->name('shop.edit');
    Route::post('users/shop-setting/update/{shop}', [App\Http\Controllers\ShopController::class, 'update'])->name('shop.update');

    Route::resource('users', App\Http\Controllers\UserController::class);
   

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


    Route::get('/unit', [UnitController::class, 'index'])->name('unit.lists');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{unit}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::post('/unit/update/{unit}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/destroy/{unit}', [UnitController::class, 'destroy'])->name('unit.destroy');



    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');




    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/product/getsubcategory', [ProductController::class, 'getsubcategory'])->name('product.getsubcategory');
    Route::post('/product/getvarientvalue', [ProductController::class, 'getvarientvalue'])->name('product.getvarientvalue');
    Route::post('/product/productComboPrice', [ProductController::class, 'productComboPrice'])->name('productCombo.price');



    Route::get('/purchase', [PurchasesController::class, 'index'])->name('purchase.index'); //purchase report here
    Route::get('/purchase/create', [PurchasesController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/store', [PurchasesController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/productPrice', [PurchasesController::class, 'productPrice'])->name('purchase.price');
    Route::get('/purchase/product/search', [PurchasesController::class, 'product_search'])->name('purchase.product.search');
    Route::get('/purchase/product/data', [PurchasesController::class, 'product_variable_data'])->name('purchase.product.data');



    Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');
    Route::get('/sale/create', [SaleController::class, 'create'])->name('sale.create');
    Route::post('/sale/store', [SaleController::class, 'store'])->name('sale.store');
    Route::get('/sale/productPrice', [SaleController::class, 'productPrice'])->name('sale.price');
    Route::get('/sale/product/search', [SaleController::class, 'product_search'])->name('sale.product.search');
    Route::get('/sale/product/data', [SaleController::class, 'product_variable_data'])->name('sale.product.data');


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

    Route::get('/report/top/purchase', [ReportController::class, 'toppurchasereport'])->name('toppurchase.report'); //Workin file
    Route::get('/report/top/sale', [ReportController::class, 'topsalereport'])->name('topsale.report'); //sale report here

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


    // Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    // Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    // Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
    // Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
    // Route::post('/shop/update/{shop}', [ShopController::class, 'update'])->name('shop.update');
    // Route::delete('/shop/destroy/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');


    Route::get('/price/group', [PriceGroupController::class, 'index'])->name('price.group');
    Route::get('/price/group/create', [PriceGroupController::class, 'create'])->name('price.group.create');
    Route::post('/price/group/store', [PriceGroupController::class, 'store'])->name('price.group.store');
    Route::get('/price/group/{id}/edit', [PriceGroupController::class, 'edit'])->name('price.group.edit');
    Route::post('/price/group/{id}/update', [PriceGroupController::class, 'update'])->name('price.group.update');
    Route::delete('/price/group/{id}/destroy', [PriceGroupController::class, 'destroy'])->name('price.group.destroy');
    Route::get('/group_product_prices/{id}', [PriceGroupController::class, 'group_product_prices'])->name('group_product_prices');
    Route::post('/group_product_prices', [PriceGroupController::class, 'group_product_prices_update'])->name('group_product_prices.update');
    Route::post('/group_product_prices/delete', [PriceGroupController::class, 'group_product_prices_delete'])->name('group_product_prices.delete');
});