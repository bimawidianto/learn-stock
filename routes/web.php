<?php

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
    return view('welcome');
});

Route::resource('products', 'ProductController');
Route::resource('purchase_orders', 'PurchaseOrderController');
Route::resource('purchase_orders.purchase_items', 'PurchaseOrder\PurchaseItemController');
Route::resource('sale_orders', 'SaleOrderController');
Route::resource('sale_orders.sale_items', 'SaleOrder\SaleItemController');
