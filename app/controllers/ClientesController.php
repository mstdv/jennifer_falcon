<?php

class ClientesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /clientes
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('clientes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /clientes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('clientes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /clientes
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nombre' 	     => 'required|min:2|max:300|unique:clientes,nombre',
			'cedula' 	     => 'required|min:3|max:20|unique:clientes,cedula',
			'rif' 	         => 'min:0|max:20|unique:clientes,rif',
			'telefono' 	     => 'min:0|max:20',
			'direccion' 	 => 'required|min:5|max:300',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$cliente = new Cliente;

			$cliente->nombre     = e(Input::get('nombre'));
			$cliente->cedula     = e(Input::get('cedula'));
			$cliente->rif        = e(Input::get('rif'));
			$cliente->direccion  = e(Input::get('direccion'));
			$cliente->telefono   = e(Input::get('telefono'));

			if ($cliente->save()) {
				return Redirect::to('/clientes');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /clientes/{id}
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
	 * GET /clientes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cliente=Cliente::where('id', $id);
		$cliente=$cliente->get();

		return View::make('clientes.edit', ['cliente'=>$cliente[0]]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /clientes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nombre' 	     => 'required|min:2|max:300|unique:clientes,nombre,'.$id.'',
			'cedula' 	     => 'required|min:3|max:20|unique:clientes,cedula,'.$id.'',
			'rif' 	         => 'min:0|max:20|unique:clientes,rif,'.$id.'',
			'telefono' 	     => 'min:0|max:20',
			'direccion' 	 => 'required|min:5|max:300',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$cliente = Cliente::find($id);

			$cliente->nombre     = e(Input::get('nombre'));
			$cliente->cedula     = e(Input::get('cedula'));
			$cliente->rif        = e(Input::get('rif'));
			$cliente->direccion  = e(Input::get('direccion'));
			$cliente->telefono   = e(Input::get('telefono'));

			if ($cliente->save()) {
				return Redirect::to('/clientes');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /clientes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cliente = Cliente::find($id);
		if ($cliente->delete()) {
			return Redirect::back();
		} else {
			return Redirect::back();
		}
	}

}