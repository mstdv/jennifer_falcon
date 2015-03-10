@extends('index')
@section('title')
	Inventario
@stop
@section('cont')

<div class="container">
	<div class="row">
		<div class="col-lg-12">

			<a href="{{URL::to('/proveedores')}}" class="btn btn-success">
				Gestionar Proveedores
			</a>
			<a href="{{URL::to('/marcas')}}" class="btn btn-success">
				Gestionar Marcas
			</a>

			<a href="{{URL::to('/productos')}}" class="btn btn-success">
				Gestionar Productos
			</a>

			<hr>

			<h3><b>Listado de productos</b></h3>

			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="10px"><b>Codigo</b></td>
					<td width="120px;"><b>Nombre</b></td>
					<td width="120px;"><b>Modelo</b></td>
					<td width="120px;"><b>Descripcion</b></td>
					<td width="70px"><b>Cantidad</b></td>
					<td width="120px;"><b>Monto</b></td>
					<td width="120px;"><b>Marca</b></td>
					<td width="120px;"><b>Proveedor</b></td>
				</tr>
				@foreach($pagination=Producto::where('cantidad', '>=', '0')->paginate(25) as $producto)
				@if($producto->cantidad==0)
					<tr class="warning">
				@else
					<tr>
				@endif
					<td><small>{{$producto->id}}</small></td>
					<td><small>{{$producto->nombre}}</small></td>
					<td><small>{{$producto->modelo}}</small></td>
					<td><small>{{$producto->descripcion}}</small></td>
					<td><small>

						@if($producto->cantidad==0)
							<b><span class="text-warning">{{$producto->cantidad}}</span></b>
						@else
							<b><span class="text-success">{{$producto->cantidad}}</span></b>
						@endif
					</small></td>
					<td><small>{{$producto->monto}}</small></td>
					<td><small>{{Marca::getInf($producto->marca_id)->nombre}}</small></td>
					<td><small>{{Proveedor::getInf($producto->proveedor_id)->nombre}}</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination->links()}}

			<div class="btn-group">
			{{Form::open(['method'=>'POST', 'url'=>'/inventario', 'class'=>'formbutton'])}}

			<a href="{{URL::to('/productos/create')}}" class="btn btn-success btn-xs">Registrar nuevo producto dentro del sistema</a>


			<button class="btn btn-xs btn-default" type="submit">
				<i class="fa fa-print"></i>
				Imprimir
			</button>
			{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@stop