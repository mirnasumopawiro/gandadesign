<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use App\category;
use App\subCategory;
use App\product;
use App\prodDesc;
use App\prodDescVal;
use App\customer;
use App\order;
use App\cart;
use App\item;
use App\itemDesc;
use App\itemDescVal;
use App\orderDetail;
use App\history;

class AdminController extends Controller
{
    //CRUD admins table via admin model

	public function getAdmin(){
		return admin::all();
	}

	public function insertAdmin(Request $request){
		$data = new admin();
		$data['email'] = $request->input('email');
		$data['pwd'] = $request->input('pwd');
		$data['name'] = $request->input('name');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateAdmin(Request $request){
		admin::where('id', '=', $request->input('id'))
				->update([
						'email' => $request->input('email'),
						'pwd' => $request->input('pwd'),
						'name' => $request->input('name'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteAdmin(Request $request){
		admin::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD categories table via category moodel DONE

	public function getCategory(){
		return category::all();
	}

	public function insertCategory(Request $request){
		$data = new category();
		$data['name'] = $request->input('name');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateCategory(Request $request){
		category::where('id', '=', $request->input('id'))
				->update(['name' => $request->input('name')]);

		return response([
			'msg' => 'success'
		]);
	}

	public function deleteCategory(Request $request){
		category::where('id', '=', $request->input('id'))->delete();
	}

	public function showByCategory($id){
		$idCategory = category::where('id', '=', $id)->value('id');
		$nameCategory = category::where('id', '=', $id)->value('name');

		$data['id']				= $idCategory;
		$data['name']			= $nameCategory;
		$data['subCategory']	= [ subCategory::where('categories_id', '=', $id)->get()];

		return $data;
	}

	//CRUD sub_categories table via subCategory moodel DONE

	public function getSubCategory(){
		return subCategory::all();
	}

	public function insertSubCategory(Request $request){
		$data = new subCategory();
		$data['categories_id'] = $request->input('categories_id');
		$data['name'] = $request->input('name');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateSubCategory(Request $request){
		subCategory::where('id', '=', $request->input('id'))
				->update(['name' => $request->input('name')]);

		return response([
			'msg' => 'success'
		]);
	}

	public function deleteSubCategory(Request $request){
		subCategory::where('id', '=', $request->input('id'))->delete();
	}

	public function showBySubCategory($id){
		$idSubCategory = subCategory::where('id', '=', $id)->value('id');
		$nameSubCategory = subCategory::where('id', '=', $id)->value('name');

		$data['id']			= $idSubCategory;
		$data['name']		= $nameSubCategory;
		$data['product']	= [product::where('sub_categories_id', '=', $id)->get()];

		return $data;
	}

	//CRUD products table via product model DONE

	public function getProduct(){
		return product::all();
	}

	public function insertProduct(Request $request){
		$data = new product();
		$data['sub_categories_id']	= $request->input('sub_categories_id');
		$data['name']				= $request->input('name');
		$data['price']				= $request->input('price');
		$data['description']		= $request->input('description');
		$data['photo']				= $request->input('photo');
		$data['tag']				= $request->input('tag');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateProduct(Request $request){
		product::where('id', '=', $request->input('id'))
				->update([
					'name' 			=> $request->input('name'),
					'price' 		=> $request->input('price'),
					'description' 	=> $request->input('description'),
					'photo' 		=> $request->input('photo'),
					'tag' 			=> $request->input('tag'),
				]);

		return response([
			'msg' => 'success'
		]);
	}

	public function deleteProduct(Request $request){
		product::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD prod_descs table via prodDesc model DONE

	public function getProdDesc(){
		return prodDesc::all();
	}

	public function insertProdDesc(Request $request){
		$data = new prodDesc();
		$data['products_id'] 	= $request->input('products_id');
		$data['size'] 			= $request->input('size');
		$data['stock'] 			= $request->input('stock');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateProdDesc(Request $request){
		prodDesc::where('id', '=', $request->input('id'))
				->update([
						'products_id' 	=> $request->input('products_id'),
						'size' 			=> $request->input('size'),
						'stock' 			=> $request->input('stock'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteProdDesc(Request $request){
		prodDesc::where('id', '=', $request->input('id'))->delete();
	}

	
	//CRUD customers table via customer model DONE

	public function getCustomer(){
		return customer::all();
	}

	public function insertCustomer(Request $request){
		$data = new customer();
		$data['email'] 		= $request->input('email');
		$data['password'] 	= $request->input('password');
		$data['fname'] 		= $request->input('fname');
		$data['lname'] 		= $request->input('lname');
		$data['addr'] 		= $request->input('addr');
		$data['city'] 		= $request->input('city');
		$data['state'] 		= $request->input('state');
		$data['zipcode'] 	= $request->input('zipcode');
		$data['country'] 	= $request->input('country');
		$data['mobile'] 	= $request->input('mobile');
		$data['gender'] 	= $request->input('gender');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateCustomer(Request $request){
		customer::where('id', '=', $request->input('id'))
				->update([
					'email'		=> $request->input('email'),
					'password'	=> $request->input('password'),
					'fname'		=> $request->input('fname'),
					'lname'		=> $request->input('lname'),
					'addr'		=> $request->input('addr'),
					'city'		=> $request->input('city'),
					'state'		=> $request->input('state'),
					'zipcode'	=> $request->input('zipcode'),
					'country'	=> $request->input('country'),
					'mobile'	=> $request->input('mobile'),
					'gender'	=> $request->input('gender')
				]);

		return response([
			'msg' => 'success'
		]);
	}

	public function deleteCustomer(Request $request){
		customer::where('id', '=', $request->input('id'))->delete();
	}

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

	//CRUD order_details table via orderDetail moodel DONE

	public function getOrderDetail(){
		return orderDetail::all();
	}

	public function insertOrderDetail(Request $request){
		$data = new orderDetail();
		$data['items_id'] = $request->input('items_id');
		$data['qty'] = $request->input('qty');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateOrderDetail(Request $request){
		orderDetail::where('id', '=', $request->input('id'))
				->update([
					'items_id' => $request->input('items_id'),
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

	//CRUD users table via User model DONE

	public function getUser(){
		return user::all();
	}

	public function insertUser(Request $request){
		$data = new user();
		$data['name'] 		= $request->input('name');
		$data['email'] 		= $request->input('email');
		$data['password'] 	= $request->input('password');
		$data['addr'] 		= $request->input('addr');
		$data['city'] 		= $request->input('city');
		$data['state'] 		= $request->input('state');
		$data['zipcode'] 	= $request->input('zipcode');
		$data['country'] 	= $request->input('country');
		$data['mobile'] 	= $request->input('mobile');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateUser(Request $request){
		customer::where('id', '=', $request->input('id'))
				->update([
					'name'		=> $request->input('name'),
					'email'		=> $request->input('email'),
					'password'	=> $request->input('password'),
					'addr'		=> $request->input('addr'),
					'city'		=> $request->input('city'),
					'state'		=> $request->input('state'),
					'zipcode'	=> $request->input('zipcode'),
					'country'	=> $request->input('country'),
					'mobile'	=> $request->input('mobile'),
				]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteUser(Request $request){
		customer::where('id', '=', $request->input('id'))->delete();
	}
}
