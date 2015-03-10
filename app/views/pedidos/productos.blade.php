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
			<h1>
				Gestion de pedido para el cliente <br> <small>
					{{Session::get('pedido.id:'.$id.'.data')->nombre}}
					{{Session::get('pedido.id:'.$id.'.data')->apellido}}
				</small>
			</h1>
			<h3><b>Listado de productos</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="120px;"><b>Nombre</b></td>
					<td width="120px;"><b>Modelo</b></td>
					<td width="120px;"><b>Descripcion</b></td>
					<td width="70px"><b>Cantidad disponible</b></td>
					<td width="120px;"><b>Monto</b></td>
					<td width="120px;"><b>Marca</b></td>
					<td width="120px;"><b>Proveedor</b></td>
					<td width="120px;"><b>Cantidad a adquirir</b></td>
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
					<td>
						<small>
							{{Form::open(['method'=>'POST', 'url'=>'/pedidos/'.$producto->id.'/'.$id.'/agregar', 'class'=>'formbutton'])}}

							{{Form::text('cantidad', 0, ['class' => 'form-control'])}}
						</small>
					</td>
					<td><small>


							<button class="btn btn-success" type="submit">
								<i class="fa fa-times"></i>
								Agregar al pedido
							</button>
						{{Form::close()}}

					</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination->links()}}
			<a href="{{URL::to('/productos/create')}}" class="btn btn-default btn-xs">Ingresar nuevo producto al sistema</a>
		</div>
	</div>
	</div>
@stop