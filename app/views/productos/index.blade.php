@extends('index')
@section('title')
	Productos
@stop
@section('cont')
	<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
	</style>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3><b>Listado de productos</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="120px;"><b>Nombre</b></td>
					<td width="120px;"><b>Modelo</b></td>
					<td width="120px;"><b>Descripcion</b></td>
					<td width="70px"><b>Cantidad</b></td>
					<td width="120px;"><b>Monto</b></td>
					<td width="120px;"><b>Marca</b></td>
					<td width="120px;"><b>Proveedor</b></td>
					<td><b>Opciones</b></td>
				</tr>
				@foreach($pagination=Producto::paginate(10) as $producto)

				@if($producto->cantidad==0)
					<tr class="warning">
				@else
					<tr>
				@endif

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

					<td><small>
						<div class="formbutton">
							<a class="btn btn-xs btn-default" href="{{URL::to('/productos/'.$producto->id.'/edit')}}">
								<i class="fa fa-pencil-square-o"></i>
								Modificar
							</a>
						</div>


						{{Form::open(['method'=>'DELETE', 'url'=>'/productos/'.$producto->id, 'class'=>'formbutton'])}}
							<button class="btn btn-xs btn-default" type="submit">
								<i class="fa fa-times"></i>
								Eliminar
							</button>
						{{Form::close()}}

					</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination->links()}}
			<a href="{{URL::to('/productos/create')}}" class="btn btn-success">Ingresar nuevo producto al sistema</a>
		</div>
	</div>
	</div>
@stop