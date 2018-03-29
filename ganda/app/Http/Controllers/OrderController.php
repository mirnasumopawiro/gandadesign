<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\cart;
use App\item;
use App\itemDesc;
use App\itemDescVal;

class OrderController extends Controller
{
    //CRUD orders table via order model
    public function getOrder(){
		return order::all();
	}

	public function insertOrder(Request $request){
		$data = new order();
		$data['carts_id'] = $request->input('carts_id');
		$data['customers_id'] = $request->input('customers_id');
		$data['dateOpen'] = $request->input('dateOpen');
		$data['dateClose'] = $request->input('dateClose');
		$data['orderStatus'] = $request->input('orderStatus');
		$data['paymentType'] = $request->input('paymentType');
		$data['paymentStatus'] = $request->input('paymentStatus');
		$data['shipType'] = $request->input('shipType');
		$data['shipPrice'] = $request->input('shipPrice');
		$data['totalPrice'] = $request->input('totalPrice');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateOrder(Request $request){
		order::where('id', '=', $request->input('id'))
				->update([
					'carts_id' => $request->input('carts_id'),
					'customers_id' => $request->input('customers_id'),
					'dateOpen' => $request->input('dateOpen'),
					'dateClose' => $request->input('dateClose'),
					'orderStatus' => $request->input('orderStatus'),
					'paymentType' => $request->input('paymentType'),
					'paymentStatus' => $request->input('paymentStatus'),					
					'shipType' => $request->input('shipType'),					
					'shipPrice' => $request->input('shipPrice'),
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

	public function insertCart(Request $request){
		$data = new cart();
		$data['items_id'] = $request->input('items_id');
		$data['qty'] = $request->input('qty');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateCart(Request $request){
		cart::where('id', '=', $request->input('id'))
				->update([
					'items_id' => $request->input('items_id'),
					'qty' => $request->input('qty'),
			]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteCart(Request $request){
		cart::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD item_descs table via itemDesc model DONE

	public function getItemDesc(){
		return itemDesc::all();
	}

	public function insertItemDesc(Request $request){
		$data = new itemDesc();
		$data['items_id'] = $request->input('items_id');
		$data['size'] = $request->input('size');
		$data['color'] = $request->input('color');
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
						'color' => $request->input('color'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteItemDesc(Request $request){
		itemDesc::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD item_desc_vals table via itemDescVal model DONE

	public function getItemDescVal(){
		return itemDescVal::all();
	}

	public function insertItemDescVal(Request $request){
		$data = new itemDescVal();
		$data['item_descs_id'] = $request->input('item_descs_id');
		$data['value'] = $request->input('value');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateItemDescVal(Request $request){
		itemDescVal::where('id', '=', $request->input('id'))
				->update([
						'item_descs_id' => $request->input('item_descs_id'),
						'value' => $request->input('value'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteItemDescVal(Request $request){
		itemDescVal::where('id', '=', $request->input('id'))->delete();
	}
}
