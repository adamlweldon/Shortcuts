<?php

class UserController extends BaseController {

	public function insertUser()
	{
		// Session::flash('name', 'email');
		$name = Input::get('name');
		$email = Input::get('email');
		$password = Input::get('password');
		$confirmation = Input::get('password_confirmation');

		$rules = array(
			'name' 					=> 'required|max:50',
			'email' 				=> 'required|email|unique:users',
			'password'				=> 'required|min:6|AlphaNum|Confirmed',
			'password_confirmation'	=> 'required|AlphaNum|min:6'
		);

		$validation = Validator::make(Input::all(), $rules);


		if ($validation->fails()) {
			return Redirect::to('users')->withErrors($validation);
		}
		else {
			// hash the password
			$hashed = Hash::make($password);
			$test = new User(); 
			$test->name = $name;
			$test->email = $email;
			$test->password = $hashed;
			if ($test->save()) {
				return Redirect::to('/success'); 
			}
		}
	}

	public function loginUser()
	{
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum' // password can only be alphanumeric and has to be greater than 3 characters
		);

		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/users')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$logindata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
			);
			// print_r($logindata);
			// exit;

			if (Auth::attempt($logindata))
			{
			    return Redirect::to('/allusers')
			     	->with('flash_notice', 'You are successfully logged in.');
			}
			else
			{
				 return Redirect::to('/users')
            		->with('flash_error', 'Your username/password combination was incorrect.')
            		->withInput();
			}
		}
	}

	// public function logoutUser()
	// {
	// 	Auth::logout();

 //    	return Redirect::to('/users')
 //        ->with('flash_notice', 'You are successfully logged out.');
	// }
}