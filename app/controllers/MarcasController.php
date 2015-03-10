<?php

class MarcasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /marcas
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('marcas.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /marcas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('marcas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /marcas
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nombre' 	     => 'required|min:2|max:300|unique:marcas,nombre',
			'url' 	     	 => '',
			'img' 	     => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$marca = new Marca;

			$marca->nombre     	= e(Input::get('nombre'));
			$marca->url     	= e(Input::get('url'));
			$marca->imagen      = Input::file('img')->getClientOriginalName();

			if ($marca->save()) {
				Input::file('img')->move("imgs",Input::file('img')->getClientOriginalName());
				return Redirect::to('/marcas');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /marcas/{id}
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
	 * GET /marcas/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$marca=Marca::where('id', $id);
		$marca=$marca->get();

		return View::make('marcas.edit', ['marca'=>$marca[0]]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /marcas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nombre' 	     => 'required|min:2|max:300|unique:marcas,nombre',
			'url' 	     	 => '',
			'img' 	     => '',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$marca = Marca::find($id);

			$marca->nombre     	= e(Input::get('nombre'));
			$marca->url     	= e(Input::get('url'));

			if(Input::file('img') != null) {
				$marca->imagen      = Input::file('img')->getClientOriginalName();
			}

			if ($marca->save()) {

				if(Input::file('img') != null) {
					Input::file('img')->move("imgs",Input::file('img')->getClientOriginalName());
				}

				return Redirect::to('/marcas');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /marcas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$marca = Marca::find($id);
		$marca->delete();
		return Redirect::back();
	}

}