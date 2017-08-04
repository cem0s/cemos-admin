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
	Route::get('/order-details/{id}/{nId?}', 'OrderController@orderDetails')->name('order-details');
	Route::get('/change-order-status', 'OrderController@changeOrderStatus')->name('change-order-status');

	Route::get('/credit-points', 'CreditPointsController@index')->name('credit-points');
	Route::post('/add-credit', 'CreditPointsController@postCreditPoints')->name('add-credit');
	
	Route::get('/get-suppliers', 'SupplierController@getSuppliers')->name('get-suppliers');
	Route::get('/get-supplier-type', 'SupplierController@getSupplierTypes')->name('get-supplier-type');
	Route::get('/get-supplier-by-type', 'SupplierController@getSupplierByType')->name('get-supplier-by-type');
	Route::get('/assign-supplier', 'SupplierController@assignSupplier')->name('assign-supplier');

	Route::get('/get-notif', 'NotificationController@getNotifs')->name('get-notif');

	Route::get('/company', 'CompanyController@index')->name('company');
	Route::post('/add-company', 'CompanyController@addCompany')->name('add-company');
	Route::get('/del-company/{id}', 'CompanyController@delCompany')->name('del-company');
	Route::get('/edit-company/{id}', 'CompanyController@editCompany')->name('edit-company');
	Route::post('/edit-company', 'CompanyController@postEditCompany')->name('edit-company');


	Route::get('/product', 'ProductController@index')->name('product');
	Route::post('/add-product', 'ProductController@addProduct')->name('add-product');
	Route::get('/del-product/{id}', 'ProductController@delProduct')->name('del-product');
	Route::get('/edit-product/{id}', 'ProductController@editProduct')->name('edit-product');
	Route::post('/edit-product', 'ProductController@postEditProduct')->name('edit-product');



});