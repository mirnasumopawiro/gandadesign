<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subCategory;
use App\product;
use App\prodDesc;
use App\prodDescVal;

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
		$data['material']			= $request->input('material');
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
					'material' 		=> $request->input('material'),
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
		$data['color'] 			= $request->input('color');
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
						'color' 		=> $request->input('color'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteProdDesc(Request $request){
		prodDesc::where('id', '=', $request->input('id'))->delete();
	}

	//CRUD prod_desc_vals table via prodDescVal model DONE

	public function getProdDescVal(){
		return prodDescVal::all();
	}

	public function insertProdDescVal(Request $request){
		$data = new prodDescVal();
		$data['prod_descs_id']	= $request->input('prod_descs_id');
		$data['value']			= $request->input('value');
		$data->save();

		return response([
			'msg' => 'success',
		],200);
	}

	public function updateProdDescVal(Request $request){
		prodDescVal::where('id', '=', $request->input('id'))
				->update([
						'prod_descs_id'	=> $request->input('prod_descs_id'),
						'value' 		=> $request->input('value'),
					]);

		return response([
			'msg' => 'success'
		],200);
	}

	public function deleteProdDescVal(Request $request){
		prodDescVal::where('id', '=', $request->input('id'))->delete();
	}

}
