	<div class="row">
		<div class="col-lg-12">
			<h3><b>Listado de productos <br> <small>
				para la fecha: {{$fecha}}
			</small></b></h3>

			<hr>

			<table border="1">
				<tr>
					<td><b>Codigo</b></td>
					<td d="120px;"><b>Nombre</b></td>
					<td d="120px;"><b>Modelo</b></td>
					<td d="120px;"><b>Descripcion</b></td>
					<td d="70px"><b>Cantidad</b></td>
					<td d="120px;"><b>Monto</b></td>
					<td d="120px;"><b>Marca</b></td>
					<td d="120px;"><b>Proveedor</b></td>
				</tr>
				@foreach($pagination=Producto::where('cantidad', '>=', '1')->get() as $producto)
				<tr>
					<td><small>{{$producto->id}}</small></td>
					<td><small>{{$producto->nombre}}</small></td>
					<td><small>{{$producto->modelo}}</small></td>
					<td><small>{{$producto->descripcion}}</small></td>
					<td><small>{{$producto->cantidad}}</small></td>
					<td><small>{{$producto->monto}}</small></td>
					<td><small>{{Marca::getInf($producto->marca_id)->nombre}}</small></td>
					<td><small>{{Proveedor::getInf($producto->proveedor_id)->nombre}}</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination->links()}}
		</div>
	</div>