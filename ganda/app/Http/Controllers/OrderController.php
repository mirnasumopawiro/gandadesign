<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\cart;
use App\item;
use App\itemDesc;

class OrderController extends Controller
{
    //CRUD orders table via order model
    public function getOrder(){
		return order::all();
	}

	public function insertOrder(Request $request){
		$data = new order();
		$data['order_details_id'] = $request->input('order_details_id');
		$data['users_id'] = $request->input('users_id');
		$data['dateOpen'] = $request->input('dateOpen');
		$data['dateClose'] = $request->input('dateClose');
		$data['orderStatus'] = $request->input('orderStatus');
		$data['paymentType'] = $request->input('paymentType');
		$data['paymentStatus'] = $request->input('paymentStatus');
		$data['totalPrice'] = $request->input('totalPrice');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateOrder(Request $request){
		order::where('id', '=', $request->input('id'))
				->update([
					'order_details_id' => $request->input('order_details_id'),
					'users_id' => $request->input('users_id'),
					'dateOpen' => $request->input('dateOpen'),
					'dateClose' => $request->input('dateClose'),
					'orderStatus' => $request->input('orderStatus'),
					'paymentType' => $request->input('paymentType'),
					'paymentStatus' => $request->input('paymentStatus'),					
					'totalPrice' => $request->input('totalPrice'),
				]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteOrder(Request $request){
		order::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD items table via item moodel DONE

	public function getItem(){
		return item::all();
	}

	public function insertItem(Request $request){
		$data = new item();
		$data['name'] = $request->input('name');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateItem(Request $request){
		item::where('id', '=', $request->input('id'))
				->update(['name' => $request->input('name')]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteItem(Request $request){
		item::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD carts table via cart moodel

	public function getCart(){
		return cart::all();
	}

	public function insertCart(Request $request, $idProd, $size, $qty){
		$data = new cart();
		$data['products_id'] = $request->input($idProd);
		$data['size'] = $request->input($size);
		$data['qty'] = $request->input($qty);
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateCart(Request $request){
		cart::where('id', '=', $request->input('id'))
				->update([
					'products_id' => $request->input('products_id'),
					'size' => $request->input('size'),
					'qty' => $request->input('qty'),
			]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteCart(Request $request){
		cart::where('id', '=', $request->input('id'))->delete();
	}

	public function checkout($idProd, $size, $qty){
		$data = new orderDetail();
		$data['products_id'] = $idProd;
		$data['size'] = $size;
		$data['qty'] = $qty;
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	//CRUD item_descs table via itemDesc model DONE

	public function getItemDesc(){
		return itemDesc::all();
	}

	public function insertItemDesc(Request $request){
		$data = new itemDesc();
		$data['items_id'] = $request->input('items_id');
		$data['size'] = $request->input('size');
		$data['stock'] = $request->input('stock');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateItemDesc(Request $request){
		itemDesc::where('id', '=', $request->input('id'))
				->update([
						'items_id' => $request->input('items_id'),
						'size' => $request->input('size'),
						'stock' => $request->input('stock'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteItemDesc(Request $request){
		itemDesc::where('id', '=', $request->input('id'))->delete();
	}
}
