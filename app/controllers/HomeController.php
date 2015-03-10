<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return View::make('home');
	}

	public function galeria()
	{
		return View::make('galeria');
	}

	public function visionmision()
	{
		return View::make('visionmision');
	}

	public function ubicacion()
	{
		return View::make('ubicacion');
	}


	public function login()
	{
		// return Hash::make('1024456');
		return View::make('login');

	}

	public function postlogin()
	{
		$rules = array(
			'email' 	 => 'required|email|min:2|max:300|exists:users,email',
			'password' 	 => 'required|min:1|max:7',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			if(Auth::attempt(['email'=>Input::get('email'), 'password'=>Input::get('password')])) {
				return Redirect::to('/');
			} else {
				Session::flash('alert', 'Ocurrio un error!.');
				return Redirect::back()
					->withInput();
			}
		}
	}

	public function backlogin()
	{
		Auth::logout();
		Session::flush();
		return Redirect::to('/');
	}

}
