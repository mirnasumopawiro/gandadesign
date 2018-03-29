<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;

class CustomerController extends Controller
{
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
}
