<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\orderDetail;
use App\history;

class PurchaseController extends Controller
{
    //CRUD order_details table via orderDetail moodel DONE

	public function getOrderDetail(){
		return orderDetail::all();
	}

	public function insertOrderDetail(Request $request){
		$data = new orderDetail();
		$data['products_id'] = $request->input($idProd);
		$data['size'] = $request->input($size);
		$data['qty'] = $request->input($qty);
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateOrderDetail(Request $request){
		orderDetail::where('id', '=', $request->input('id'))
				->update([
					'products_id' => $request->input('products_id'),
					'size' => $request->input('size'),
					'qty' => $request->input('qty'),
			]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteOrderDetail(Request $request){
		orderDetail::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD histories table via history model

	public function getHistory(){
		return history::all();
	}

	public function insertHistory(Request $request){
		$data = new history();
		$data['customers_id'] = $request->input('customers_id');
		$data['orders_id'] = $request->input('orders_id');
		$data['order_details_id'] = $request->input('order_details_id');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateHistory(Request $request){
		history::where('id', '=', $request->input('id'))
			->update([
				'customers_id' => $request->input('customers_id'),
				'orders_id' => $request->input('orders_id'),
				'order_details_id' => $request->input('order_details_id'),
			]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteHistory(Request $request){
		history::where('id', '=', $request->input('id'))->delete();
	}
}
