<?php
use Carbon\Carbon;

class ProductosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /productos
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('productos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /productos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('productos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /productos
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nombre' 	             => 'required|min:1|max:120|unique:productos,nombre',
			'modelo' 	     	     => 'required|min:1|max:30',
			'descripcion' 	     	 => 'required|min:1|max:300',
			'monto' 	     	     => 'required|min:1|max:10',
			'marca_id' 	     	     => 'required|min:1|max:4',
			'proveedor_id' 	     	 => 'required|min:1|max:4',
			'cantidad' 	     		 => 'required|min:1|max:4',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$producto = new Producto;

			$producto->nombre     	  = e(Input::get('nombre'));
			$producto->modelo     	  = e(Input::get('modelo'));
			$producto->descripcion    = e(Input::get('descripcion'));
			$producto->monto     	  = e(Input::get('monto'));
			$producto->marca_id       = e(Input::get('marca_id'));
			$producto->proveedor_id   = e(Input::get('proveedor_id'));
			$producto->cantidad   	  = e(Input::get('cantidad'));


			if ($producto->save()) {
				return Redirect::to('/productos');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /productos/{id}
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
	 * GET /productos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$productos=Producto::where('id', $id);
		$productos=$productos->get();

		return View::make('productos.edit', ['producto'=>$productos[0]]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /productos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nombre' 	             => 'required|min:1|max:120|unique:productos,nombre,'.$id.'',
			'modelo' 	     	     => 'required|min:1|max:30',
			'descripcion' 	     	 => 'required|min:1|max:300',
			'monto' 	     	     => 'required|min:1|max:10',
			'marca_id' 	     	     => 'required|min:1|max:4',
			'proveedor_id' 	     	 => 'required|min:1|max:4',
			'cantidad' 	     	 	 => 'required|min:1|max:4',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$producto = Producto::find($id);

			$producto->nombre     	  = e(Input::get('nombre'));
			$producto->modelo     	  = e(Input::get('modelo'));
			$producto->descripcion    = e(Input::get('descripcion'));
			$producto->monto     	  = e(Input::get('monto'));
			$producto->marca_id       = e(Input::get('marca_id'));
			$producto->proveedor_id   = e(Input::get('proveedor_id'));
			$producto->cantidad   	  = e(Input::get('cantidad'));


			if ($producto->save()) {
				return Redirect::to('/productos');
			} else {
				return Redirect::back()
				->withInput();
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /productos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$producto = Producto::find($id);
		$producto->delete();
		return Redirect::back();
	}

	public function inventario()
	{
		return View::make('productos.inventario');
	}

	public function printInventario()
	{
	    $html=View::make('productos.inventario_pdf', ['fecha' => Carbon::now(new DateTimeZone('America/Caracas'))]);
	    return PDF::load($html, 'A4', 'portrait')->show();
	}

}