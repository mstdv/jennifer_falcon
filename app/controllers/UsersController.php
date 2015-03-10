<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		// si es adm de ventas no puede entrar
		if (Auth::user()->rol == 1) {
			return Redirect::to('/');
		} else {
			return View::make('users.index');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'email' 	 => 'required|email|min:2|max:300|unique:users,email',
			'password' 	 => 'required|min:1|max:7',
			'nombre' 	 => 'required|min:1|max:12',
			'apellido' 	 => 'required|min:1|max:12',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = new User;

			$user->email    = e(Input::get('email'));
			$user->password = Hash::make(e(Input::get('password')));
			$user->nombre   = e(Input::get('nombre'));
			$user->apellido = e(Input::get('apellido'));
			$user->rol      = e(Input::get('rol'));

			if ($user->save()) {
				return Redirect::to('/users');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user=User::where('id', $id);
		$user=$user->get();

		return View::make('users.edit', ['user'=>$user[0]]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'email' 	 => 'required|email|min:2|max:300|unique:users,email,'.$id.'',
			'password' 	 => 'min:1|max:7',
			'nombre' 	 => 'required|min:1|max:12',
			'apellido' 	 => 'required|min:1|max:12',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = User::find($id);

			$user->email    = e(Input::get('email'));

				if (e(Input::get('password')) != null) {
					$user->password = Hash::make(e(Input::get('password')));
				}

			$user->nombre   = e(Input::get('nombre'));
			$user->apellido = e(Input::get('apellido'));
			$user->rol      = e(Input::get('rol'));

			if ($user->save()) {
				return Redirect::to('/users');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if ($user->delete()) {
			return Redirect::back();
		} else {
			return Redirect::back();
		}
	}

	public function changeState($id)
	{
		$user = User::find($id);

		if ($user->estado == 0) {
			$user->estado = 1;
			$user->save();
		} else {
			$user->estado = 0;
			$user->save();
		}

		return Redirect::back();
	}

}