<?php

use Illuminate\Support\Facades\Route;

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


/**
 * Auth routes
 */
Route::group(['namespace' => 'Auth'], function () {

    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    if (config('auth.users.registration')) {
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
    }

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');

    // Confirmation Routes...
    if (config('auth.users.confirm_email')) {
        Route::get('confirm/{user_by_code}', 'ConfirmController@confirm')->name('confirm');
        Route::get('confirm/resend/{user_by_email}', 'ConfirmController@sendEmail')->name('confirm.send');
    }

    // Social Authentication Routes...
    Route::get('social/redirect/{provider}', 'SocialLoginController@redirect')->name('social.redirect');
    Route::get('social/login/{provider}', 'SocialLoginController@login')->name('social.login');
});

/**
 * Backend routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Master Data
    // Products
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('products/create', 'ProductController@create')->name('products.create');
    Route::post('products', 'ProductController@store')->name('products.store');
    Route::get('products/{product}', 'ProductController@show')->name('products.show');
    Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('products/{product}', 'ProductController@update')->name('products.update');
    Route::delete('products/{id}', 'ProductController@destroy')->name('products.destroy');
    // Customers
    Route::get('customers', 'CustomerController@index')->name('customers');
    Route::get('customers/create', 'CustomerController@create')->name('customers.create');
    Route::post('customers', 'CustomerController@store')->name('customers.store');
    Route::get('customers/{customer}', 'CustomerController@show')->name('customers.show');
    Route::get('customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::put('customers/{customer}', 'CustomerController@update')->name('customers.update');
    Route::any('customers/{id}/destroy', 'CustomerController@destroy')->name('customers.destroy');
    // Suppliers
    Route::get('suppliers', 'SupplierController@index')->name('suppliers');
    Route::get('suppliers/create', 'SupplierController@create')->name('suppliers.create');
    Route::post('suppliers', 'SupplierController@store')->name('suppliers.store');
    Route::get('suppliers/{supplier}', 'SupplierController@show')->name('suppliers.show');
    Route::get('suppliers/{supplier}/edit', 'SupplierController@edit')->name('suppliers.edit');
    Route::put('suppliers/{supplier}', 'SupplierController@update')->name('suppliers.update');
    Route::any('suppliers/{id}/destroy', 'SupplierController@destroy')->name('suppliers.destroy');


    // Users
    Route::get('users', 'UserController@index')->name('users');
    Route::get('users/restore', 'UserController@restore')->name('users.restore');
    Route::get('users/{id}/restore', 'UserController@restoreUser')->name('users.restore-user');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::any('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::get('permissions', 'PermissionController@index')->name('permissions');
    Route::get('permissions/{user}/repeat', 'PermissionController@repeat')->name('permissions.repeat');
    Route::get('dashboard/log-chart', 'DashboardController@getLogChartData')->name('dashboard.log.chart');
    Route::get('dashboard/registration-chart', 'DashboardController@getRegistrationChartData')->name('dashboard.registration.chart');

    // sales order
    Route::get('sales/orders', 'SalesOrderController@index')->name('sales.orders');
    Route::get('sales/orders/create', 'SalesOrderController@create')->name('sales.orders.create');
    Route::post('sales/orders', 'SalesOrderController@store')->name('sales.orders.store');
    Route::get('sales/orders/{sales_order}', 'SalesOrderController@show')->name('sales.orders.show');
    Route::get('sales/orders/{sales_order}/edit', 'SalesOrderController@edit')->name('sales.orders.edit');
    Route::put('sales/orders/{sales_order}', 'SalesOrderController@update')->name('sales.orders.update');
    Route::any('sales/orders/{id}/destroy', 'SalesOrderController@destroy')->name('sales.orders.destroy');

    // sales invoice
    Route::get('sales/invoice', 'SalesInvoiceController@index')->name('sales.invoices');
    Route::get('sales/invoice/create', 'SalesInvoiceController@create')->name('sales.invoices.create');
    Route::post('sales/invoice', 'SalesInvoiceController@store')->name('sales.invoices.store');
    Route::get('sales/invoice/{sales_invoice}', 'SalesInvoiceController@show')->name('sales.invoices.show');
    Route::get('sales/invoice/{sales_invoice}/edit', 'SalesInvoiceController@edit')->name('sales.invoices.edit');
    Route::put('sales/invoice/{sales_invoice}', 'SalesInvoiceController@update')->name('sales.invoices.update');
    Route::any('sales/invoice/{id}/destroy', 'SalesInvoiceController@destroy')->name('sales.invoices.destroy');

    // purchase order
    Route::get('purchase/orders', 'PurchaseOrderController@index')->name('purchase.orders');
    Route::get('purchase/orders/create', 'PurchaseOrderController@create')->name('purchase.orders.create');
    Route::post('purchase/orders', 'PurchaseOrderController@store')->name('purchase.orders.store');
    Route::get('purchase/orders/{purchase_order}', 'PurchaseOrderController@show')->name('purchase.orders.show');
    Route::get('purchase/orders/{purchase_order}/edit', 'PurchaseOrderController@edit')->name('purchase.orders.edit');
    Route::put('purchase/orders/{purchase_order}', 'PurchaseOrderController@update')->name('purchase.orders.update');
    Route::any('purchase/orders/{id}/destroy', 'PurchaseOrderController@destroy')->name('purchase.orders.destroy');

    // purchase invoice
    Route::get('purchase/invoice', 'PurchaseInvoiceController@index')->name('purchase.invoice');
    Route::get('purchase/invoice/create', 'PurchaseInvoiceController@create')->name('purchase.invoice.create');
    Route::post('purchase/invoice', 'PurchaseInvoiceController@store')->name('purchase.invoice.store');
    Route::get('purchase/invoice/{purchase_invoice}', 'PurchaseInvoiceController@show')->name('purchase.invoice.show');
    Route::get('purchase/invoice/{purchase_invoice}/edit', 'PurchaseInvoiceController@edit')->name('purchase.invoice.edit');
    Route::put('purchase/invoice/{purchase_invoice}', 'PurchaseInvoiceController@update')->name('purchase.invoice.update');
    Route::any('purchase/invoice/{id}/destroy', 'PurchaseInvoiceController@destroy')->name('purchase.invoice.destroy');

    // receiving
    Route::get('receiving', 'ReceivingController@index')->name('purchase.receiving');
    Route::get('receiving/create', 'ReceivingController@create')->name('purchase.receiving.create');
    Route::post('receiving', 'ReceivingController@store')->name('purchase.receiving.store');
    Route::get('receiving/{receiving}', 'ReceivingController@show')->name('purchase.receiving.show');
    Route::get('receiving/{receiving}/edit', 'ReceivingController@edit')->name('purchase.receiving.edit');
    Route::put('receiving/{receiving}', 'ReceivingController@update')->name('purchase.receiving.update');
    Route::any('receiving/{id}/destroy', 'ReceivingController@destroy')->name('purchase.receiving.destroy');




});


Route::get('/', 'HomeController@index');

/**
 * Membership
 */
Route::group(['as' => 'protection.'], function () {
    Route::get('membership', 'MembershipController@index')->name('membership')->middleware('protection:' . config('protection.membership.product_module_number') . ',protection.membership.failed');
    Route::get('membership/access-denied', 'MembershipController@failed')->name('membership.failed');
    Route::get('membership/clear-cache/', 'MembershipController@clearValidationCache')->name('membership.clear_validation_cache');
});
