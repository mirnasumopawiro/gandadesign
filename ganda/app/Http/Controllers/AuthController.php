<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	$credentials = $request->only(
            'name', 
            'email', 
            'password', 
            'addr', 
            'city', 
            'state', 
            'zipcode', 
            'country', 
            'mobile'
        );

    	$rules = [
    		'name' => 'required|max:255',
    		'email' => 'required|email|max:255|unique:users',
            'addr' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zipcode' => 'required|max:8',
            'country' => 'required|max:255',
            'mobile' => 'required|max:15',
            
    	];

    	$validator = Validator::make($credentials, $rules);
    	if($validator->fails()) {
    		return response()->json(['success'=> false, 'error'=> $validator->messages()]);
    	}

    	$name = $request->name;
    	$email = $request->email;
    	$password = $request->password;
        $addr = $request->addr;
        $city = $request->city;
        $state = $request->state;
        $zipcode = $request->zipcode;
        $country = $request->country;
        $mobile = $request->mobile;

    	$user = User::create([
            'name'      => $name, 
            'email'     => $email, 
            'password'  => Hash::make($password),
            'addr'      => $addr,
            'city'      => $city,
            'state'     => $state,
            'zipcode'   => $zipcode,
            'country'   => $country,
            'mobile'    => $mobile,

        ]);

    	// $verification_code = str_random(30);
    	// DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code])

    	// $subject = "Please verify your email address.";
    	// Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
    	// 	function($mail) use ($email, $name, $subject){
    	// 		$mail ->from(getenv('FROM_EMAIL_ADDRESS'), "From User/Company Name Goes Here");
    	// 		$mail->to($email, $name);
    	// 		$mail->subject($subject);

    	// });
    	 return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email.']);
    }

    // public function verifyUser($verification_code)
    // {
    // 	$check = DB::table('user_verifications')->where('token',$verification_code)->first();

    // 	if(!is_null($check)){
    // 		$user = User::find($check->user_id);

    // 		if($user->is_verified == 1){
    // 			return response()->json([
    // 				'success' => true,
    // 				'message' -> 'Account already verified'
    // 			]);
    // 		}

    // 		$user->update(['is_verified' => 1]);
    // 		DB::table('user_verifications')->where('token',$verification_code)->delete();

    // 		return response()->json([
    // 			'success' => true,
    // 			'message' => 'You have successfully verified your email address.'
    // 		]);
    // 	}

    // 	return response()->json(['success'=>false, 'error'=> "Verification code is invalid."]);
    // }

    public function login(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required',
    	];

    	$validator = Validator::make($credentials, $rules);
    	if($validator->fails()){
    		return response()->json(['success'=> false, 'error'=> $validator->messages()]);
    	}

    	//$credentials['is_verified'] = 1;

    	try{
    		//attempt to verify the credentials and create token for use
    		if (! $token = JWTAuth::attempt($credentials)) {
    			return response()->json(['success' => false, 'error' => 'We cannot find an account with this credentials. Please make sure you entered the right information and that you have verified your email address.'], 401);
    		}
    	} catch (JWTException $e) {
    		//something went wrong whilst attempting to encode the token
    		return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
    	}

    	//all good so return the token
    	return response()->json(['success' => true, 'data' => [ 'token' => $token ]]);
    }

    /**
    * LOG OUT
    * Invalidate token so user cannot use it anmore
    * User have to relogin to get a new token
    */

    public function logout(Request $request) {
    	//$this->validate($request, ['token' => 'required']);

    	try {
    		JWTAuth::invalidate();
    		return response()->json(['success' => true, 'message' => "You have successfully logged out."]);
    	} catch (JWTException $e) {
    		//something went wrong whilst attempting to encode token
    		return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    	}
    }

    /**
    * API Recover Password
    */

    // public function recover(Request $request)
    // {
    // 	$user = User::where('email', $request->email)->first();
    // 	if (!$user) {
    // 		$error_message = "Your email address was not found.";
    // 		return response()->json(['success' => false, 'error' => ['email' => $error_message]], 401);
    // 	}

    // 	try {
    // 		Password::sendResetLink($request->only('email'), function (Message $message) {
    // 			$message->subject('Your Password Reset Link');
    // 		});
    // 	} catch (\Exception $e) {
    // 		//Return with error
    // 		$error_message = $e->getMessage();
    // 		return response()->json(['success' => false, 'error' => $error_message], 401);
    // 	}

    // 	return response()->json([
    // 		'success' => true, 'data' => ['message'=> 'A reset email has been sent! Please check your email.']
    // 	]);
    // }
}
