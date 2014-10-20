<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('users', function()
{
	$users = User::all();
	return View::make('users')->with('users', $users);
});

// to register
Route::post('register', 'UserController@insertUser');

// to login
Route::post('login', 'UserController@loginUser');

// to logout
Route::post('logout', function()
{
	Auth::logout();
    return Redirect::to('users');
});

Route::get('success', function()
{
	$users = User::all();
	return View::make('success')->with('users', $users);
});

Route::get('allusers', function()
{
	$users = User::all();
	return View::make('allusers')->with('users', $users);
});