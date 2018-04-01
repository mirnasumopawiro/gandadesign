<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subCategory;
use App\product;
use App\prodDesc;
use App\cart;
use App\item;
use App\orderDetail;

class CatalogController extends Controller
{
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
		return subCategory::where('categories_id', '=', $id)->get();

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

	public function getProductById($id){
 		return product::where('id', '=', $id)->first();
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

	//Add Cart
	public function addCart($id, $size, $qty){
		$currStock = prodDesc::where('products_id', '<=', $id)->value('stock');
		if ($currStock < $qty){
			return response([
				'msg' => 'Sorry, our current stock is '. $currStock
			]);
		}
		else{
			return $this->insertCart($id, $size, $qty);
			// return response([
			// 	'msg' => 'Added to cart'
			// ]);
		}
	}

	public function insertCart($userId, $idProd, $size, $qty){
		$data = new cart();
		$data['products_id'] = $idProd;
		$data['users_id'] = $userId;
		$data['size'] = $size;
		$data['qty'] = $qty;
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function showCart(){
		return cart::all();
	}

	// public function checkout($idProd, $size, $qty){
	// 	$data = new orderDetail();
	// 	$data['products_id'] = $idProd;
	// 	$data['size'] = $size;
	// 	$data['qty'] = $qty;
	// 	$data->save();

	// 	return response([
	// 		'msg' => 'success',
	// 	],200);
	// }

	public function checkout($id){
		$datas = cart::where('users_id', '=', $id)->get();
		foreach ($datas as $item) {
			$data = new orderDetail();
			$data['products_id'] = $item['products_id'];
			$data['size'] = $item['size'];
			$data['qty'] = $item['qty'];
			$data->save();
		}

		cart::where('users_id',$id)->delete();

		return response([
			'msg' => 'success',
		],200);
	}

	public function deleteCart($id){
		cart::where('id', '<=', $id)->delete();
	}


}
