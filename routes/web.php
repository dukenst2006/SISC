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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// AUTH
Auth::routes();


/* USERS */
Route::get('/user/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/user/profile', 'ProfileController@index')->name('profile');
Route::get('/user/invoice', 'InvoiceController@userLastInvoice')->name('user-last-invoice');
Route::get('/user/invoices', 'InvoiceController@userInvoices')->name('user-invoices');

Route::patch('/user/profile', 'ProfileController@update');
Route::patch('/user/password', 'ProfileController@changePassword');
/* /USERS */

Route::get('/faq', 'FAQController@index')->name('faq');


/* COMPANIES */
Route::get('/company/{id?}', 'CompanyController@show')->where('id', '[0-9]+')->name('company');
Route::patch('/company/update', 'CompanyController@update');
Route::get('/companies', 'CompanyController@showAll')->name('companies');
/* /COMPANIES */


/* CUSTOMERS */
Route::get('/customer/{id?}', 'CustomerController@show')->where('id', '[0-9]+')->name('customer');
Route::patch('/customer/update', 'CustomerController@update');
Route::get('/customers', 'CustomerController@showAll')->name('customers');
/* /CUSTOMERS */


/* PRODUCTS */
Route::get('/product/{id}', 'ProductController@edit')
    ->where('id', '[0-9]+')
    ->name('product-edit');

Route::patch('/product', 'ProductController@update')
    ->name('product-update');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/add/{id}', 'ProductController@index')
    ->where('id', '[0-9]+')
    ->name('add-product');
/* /PRODUCTS */


// INVOICES
Route::get('/user/invoice', 'InvoiceController@userLastInvoice')->name('last-invoice');


/* CART */
Route::get('/cart', 'InvoiceCartController@index')->name('cart');

Route::post('/cart/customer', 'InvoiceCartController@setCartCustomer')
    ->name('cart-add-customer');

Route::get('/cart/add/{id}/{quantity}', 'InvoiceCartController@add')
    ->where('id', '[0-9]+')
    ->where('quantity', '[0-9]+')
    ->name('cart-add');

Route::get('/cart/remove/{id}', 'InvoiceCartController@remove')
    ->where('id', '[0-9]+')
    ->name('cart-remove');

Route::post('/cart/update', 'InvoiceCartController@update')->name('cart-update');
Route::get('/cart/destroy', 'InvoiceCartController@destroy')->name('cart-destroy');
Route::post('/invoice/create', 'InvoiceCartController@createInvoice')->name('cart-finalize');
/* /CART */


// Debug
Route::get('/debug', 'DebugController@index');
Route::get('/debug/invoices', 'DebugController@invoices');
Route::get('/debug/user/invoices', 'DebugController@userInvoices');
Route::get('/debug/user/invoice', 'DebugController@userLastInvoice');

/* STATISTICS */
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
