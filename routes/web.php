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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','web']], function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/orders', 'OrderController@index')->name('orders');
	Route::get('/credit-points', 'CreditPointsController@index')->name('credit-points');
	Route::get('/order-details/{id}', 'OrderController@orderDetails')->name('order-details');
	Route::get('/change-order-status', 'OrderController@changeOrderStatus')->name('change-order-status');
	Route::get('/get-suppliers', 'SupplierController@getSuppliers')->name('get-suppliers');
	Route::get('/get-supplier-type', 'SupplierController@getSupplierTypes')->name('get-supplier-type');
	Route::get('/get-supplier-by-type', 'SupplierController@getSupplierByType')->name('get-supplier-by-type');
	Route::get('/assign-supplier', 'SupplierController@assignSupplier')->name('assign-supplier');

	Route::post('/add-credit', 'CreditPointsController@postCreditPoints')->name('add-credit');
});