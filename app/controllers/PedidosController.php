<?php
use Carbon\Carbon;
class PedidosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pedidos
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('pedidos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pedidos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pedidos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /pedidos/{id}
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
	 * GET /pedidos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /pedidos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pedidos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$pedido = Pedido::find($id);
		$pedido->delete();
		return Redirect::back();
	}


	public function nuevoPedido($id)
	{
		$user = Cliente::where('id', $id);
		if ($user->count() == 0) {
			return Redirect::to('/');
		} else {
			$user = $user->get();
			$user = $user[0];

			Session::set('pedido.id:'.$id, $id);
			Session::set('pedido.id:'.$id.'.data', $user);
			Session::set('pedido.id:'.$id.'.productos', '0:0');

			return Redirect::to('/pedidos/productos/'.$id);
		}
	}

	public function productos($id)
	{
		return View::make('pedidos.productos', ['id' => $id]);
	}

	public function agregar($producto, $cliente)
	{
		if (Input::get('cantidad') == 0) {
			return Redirect::back();
		}

		$dd = Producto::where('id', $producto)->where('cantidad', '>=', Input::get('cantidad'));

		if ($dd->count() == 0) {
			Session::flash('alert', 'No hay la suficiente cantidad disponible para poder procesar un pedido para esta ocacion.');
			return Redirect::back();
		}

		$cantidad = Input::get('cantidad');

		$listado = Session::get('pedido.id:'.$cliente.'.productos');
		$listado = str_replace('0:0', '', $listado);

		if ($listado == null) {
			$listado .= ''.$producto.':'.$cantidad;
		} else {
			$listado .= ','.$producto.':'.$cantidad;
		}

		Session::set('pedido.id:'.$cliente.'.productos', $listado);
		return Redirect::to('/pedidos/cliente/'.$cliente);
	}

	public function estadoIndividual($id)
	{
		if (Session::get('pedido.id:'.$id.'.productos') == null) {
			return Redirect::to('/pedidos/productos/'.$id);
		}

		return View::make('pedidos.show', ['pedido'=>Session::get('pedido.id:'.$id)]);
	}

	public function removerElemento($elemento,$cliente)
	{
		$listado = Session::get('pedido.id:'.$cliente.'.productos');
		$nlistado = str_replace(','.$elemento, '', $listado);

		Session::set('pedido.id:'.$cliente.'.productos', $nlistado);

		return Redirect::to('/pedidos/productos/'.$cliente);
	}

	public function procesar($id)
	{
			$pedido = Session::get('pedido.id:'.$id);

			$productos = explode(',', $pedido['productos']);
			$cantidad = count($productos);

			$total = 0;

			foreach ($productos as $key => $value) {
				$pro = explode(':', $value);
				$preOrde = Pre::where('id', $id)
					->where('producto', $pro[0]);

				if ($preOrde->count() == 1) {

					$rr = DB::table('pres')
		            ->where('id', $id)->where('producto', $pro[0])
		            ->get();

		            $contador = $rr[0]->cantidad + $pro[1];

					DB::table('pres')
		            ->where('id', $id)->where('producto', $pro[0])
		            ->update(array('cantidad' => $contador));

				} else {
					$yy = new Pre;
					$yy->id = $id;
					$yy->cantidad = $pro[1];
					$yy->producto = $pro[0];
					$yy->save();
				}

			}

			$hh = Pre::where('id', $id);

			foreach ($hh->get() as $value) {
				$tt = Producto::where('id', $value->producto)->get();

				if ($tt[0]->cantidad < $value->cantidad) {
					DB::table('pres')
		            ->where('id', $id)
		            ->delete();

					Session::flash('alert', 'La cantidad del producto: '.$tt[0]->nombre.': '.$value->cantidad.' Es mayor a la cantidad disponible en inventario...');
					return Redirect::back()->withInput();
				}
			}

			for ($i=0; $i < $cantidad; $i++) {

				$data = explode(':', $productos[$i]);

				$total +=
					(Producto::getInf($data[0])->monto * $data[1]) +
					(((Producto::getInf($data[0])->monto * $data[1])*12)/100);

				$gg = Producto::find($data[0]);

				$ncantidad = $gg->cantidad - $data[1];

				$gg->cantidad = $ncantidad;
				$gg->save();
			}

			$npedido = new Pedido;

			$npedido->productos = $pedido['productos'];

			$npedido->cliente = $id;

			$npedido->total = $total;

			if ($npedido->save()) {
				Session::remove('pedido.id:'.$id);
				DB::table('pres')
		            ->where('id', $id)
		            ->delete();
				return Redirect::to('/pedidos');
			} else {
				return Redirect::back()
				->withInput();
			}



	}

	public function reporte()
	{
		return View::make('pedidos.reporte');
	}

	public function reportepost()
	{
		$rules = array(
			'f1' 	     => 'required|min:2|max:70|date_format:"Y-m-d"',
			'f2' 	     => 'required|min:2|max:70|date_format:"Y-m-d"',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
    		$html=View::make('pedidos.reporte_pdf', ['fecha' => Carbon::now(new DateTimeZone('America/Caracas')),'f1' => Input::get('f1'), 'f2' => Input::get('f2')]);
		    return PDF::load($html, 'A4', 'portrait')->show();
		}
	}
}