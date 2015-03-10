<?php

class ProveedoresController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /proveedores
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('proveedores.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /proveedores/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('proveedores.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /proveedores
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nombre' 	      => 'required|min:2|max:300|unique:proveedores,nombre',
			'representante'	  => 'required|min:3|max:20',
			'telefono' 	      => 'required|min:3|max:20',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$proveedor = new Proveedor;

			$proveedor->nombre          = e(Input::get('nombre'));
			$proveedor->representante   = e(Input::get('representante'));
			$proveedor->telefono        = e(Input::get('telefono'));

			if ($proveedor->save()) {
				return Redirect::to('/proveedores');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /proveedores/{id}
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
	 * GET /proveedores/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$proveedor=Proveedor::where('id', $id);
		$proveedor=$proveedor->get();

		return View::make('proveedores.edit', ['proveedor'=>$proveedor[0]]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /proveedores/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nombre' 	      => 'required|min:2|max:300|unique:proveedores,nombre,'.$id.'',
			'representante'	  => 'required|min:3|max:20',
			'telefono' 	      => 'required|min:3|max:20',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$proveedor = Proveedor::find($id);

			$proveedor->nombre          = e(Input::get('nombre'));
			$proveedor->representante   = e(Input::get('representante'));
			$proveedor->telefono        = e(Input::get('telefono'));

			if ($proveedor->save()) {
				return Redirect::to('/proveedores');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /proveedores/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$proveedor = Proveedor::find($id);
		if ($proveedor->delete()) {
			return Redirect::back();
		} else {
			return Redirect::back();
		}
	}

}