<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

	Route::get('getCustomer', 'CustomerController@getCustomer');
	Route::post('insertCustomer', 'CustomerController@insertCustomer');
	Route::delete('deleteCustomer', 'CustomerController@deleteCustomer');
	Route::put('updateCustomer', 'CustomerController@updateCustomer');

	Route::get('getCategory', 'CatalogController@getCategory');
	Route::get('checkStock/{id}/{qty}', 'CatalogController@checkStock');
	Route::post('insertCategory', 'CatalogController@insertCategory');
	Route::delete('deleteCategory', 'CatalogController@deleteCategory');
	Route::put('updateCategory', 'CatalogController@updateCategory');
	Route::get('showByCategory/{id}', 'CatalogController@showByCategory');

	Route::get('getSubCategory', 'CatalogController@getSubCategory');
	Route::post('insertSubCategory', 'CatalogController@insertSubCategory');
	Route::delete('deleteSubCategory', 'CatalogController@deleteSubCategory');
	Route::put('updateSubCategory', 'CatalogController@updateSubCategory');
	Route::get('showBySubCategory/{id}', 'CatalogController@showBySubCategory');

	Route::get('getProduct', 'CatalogController@getProduct');
	Route::get('getProduct/{id}', 'CatalogController@getProductById');
	Route::post('insertProduct', 'CatalogController@insertProduct');
	Route::delete('deleteProduct', 'CatalogController@deleteProduct');
	Route::put('updateProduct', 'CatalogController@updateProduct');

	Route::get('getProdDesc', 'CatalogController@getProdDesc');
	Route::post('insertProdDesc', 'CatalogController@insertProdDesc');
	Route::delete('deleteProdDesc', 'CatalogController@deleteProdDesc');
	Route::put('updateProdDesc', 'CatalogController@updateProdDesc');

	Route::get('getOrder', 'OrderController@getOrder');
	Route::post('insertOrder', 'OrderController@insertOrder');
	Route::delete('deleteOrder', 'OrderController@deleteOrder');
	Route::put('updateOrder', 'OrderController@updateOrder');

	Route::get('getCart', 'OrderController@getCart');
	Route::post('insertCart', 'OrderController@insertCart');
	Route::delete('deleteCart', 'OrderController@deleteCart');
	Route::put('updateCart', 'OrderController@updateCart');

	Route::get('getItem', 'OrderController@getItem');
	Route::post('insertItem', 'OrderController@insertItem');
	Route::delete('deleteItem', 'OrderController@deleteItem');
	Route::put('updateItem', 'OrderController@updateItem');

	Route::get('getItemDesc', 'OrderController@getItemDesc');
	Route::post('insertItemDesc', 'OrderController@insertItemDesc');
	Route::delete('deleteItemDesc', 'OrderController@deleteItemDesc');
	Route::put('updateItemDesc', 'OrderController@updateItemDesc');

	Route::get('getOrderDetail', 'PurchaseController@getOrderDetail');
	Route::post('insertOrderDetail', 'PurchaseController@insertOrderDetail');
	Route::delete('deleteOrderDetail', 'PurchaseController@deleteOrderDetail');
	Route::put('updateOrderDetail', 'PurchaseController@updateOrderDetail');

	Route::get('getHistory', 'PurchaseController@getHistory');
	Route::post('insertHistory', 'PurchaseController@insertHistory');
	Route::delete('deleteHistory', 'PurchaseController@deleteHistory');
	Route::put('updateHistory', 'PurchaseController@updateHistory');

	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::get('logout', 'AuthController@logout');
	