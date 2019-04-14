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
    return view('home');
});

Auth::routes();

Route::get('books/data', 'BookController@data')->name('books.data');
Route::resource('customers', 'CustomerController');
Route::resource('books', 'BookController');
Route::get('carts/create', 'CartController@create')->name('carts.create');
Route::post('carts/create', 'CartController@store')->name('carts.store');
Route::prefix('customers')->group(function () {
    Route::get('by-phone/{phone}', 'CustomerController@getByPhone');
});
Route::get('data', 'CustomerController@data')->name('customers.data');
Route::resource('customers', 'CustomerController');
Route::get('reports', 'ReportController@index');
Route::get('reports/sales/detail', 'ReportController@salesDetail');
Route::get('reports/sales/data', 'ReportController@salesDataTable')->name('sales.data');
Route::get('reports/sales/show-child/{id}', 'ReportController@showChildSales');
Route::get('reports/sales/saleInt', 'ReportController@salesInt');
