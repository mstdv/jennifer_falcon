@extends('index')
@section('title')
	Gestion de pedidos y clientes
@stop
@section('cont')
	<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
		.label { font-size: 10px; margin: 2px; }
	</style>

	<div class="container">
	<div class="row">
		<div class="col-lg-12">

			<div class="well">
				A continuacion se muestra la lista de los clientes dentro del sistema, podra modificarlos, eliminarlos y a su vez tambien podra gestionar nuevos pedidos, colo precionando sobre procesar nuevo pedido.
			</div>
			<h3><b>Listado de clientes</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="120px;"><b>Nombre</b></td>
					<td width="70px;"><b>Cedula</b></td>
					<td width="140px;"><b>Rif</b></td>
					<td width="300px;"><b>Direccion</b></td>
					<td width="70px;"><b>Telefono</b></td>
					<td><b>Opciones</b></td>
				</tr>
				@foreach($pagination=Cliente::paginate(10) as $cliente)
				<tr>
					<td><small> {{$cliente->nombre}} </small></td>
					<td><small> {{$cliente->cedula}} </small></td>
					<td><small> {{$cliente->rif}} </small></td>
					<td><small> {{$cliente->direccion}} </small></td>
					<td><small> {{$cliente->telefono}} </small></td>

					<td><small>
						<div class="formbutton">
							<a class="btn btn-xs btn-default" href="{{URL::to('/clientes/'.$cliente->id.'/edit')}}">
								<i class="fa fa-pencil-square-o"></i>
								Modificar
							</a>
						</div>


						{{Form::open(['method'=>'DELETE', 'url'=>'/clientes/'.$cliente->id, 'class'=>'formbutton'])}}
							<button class="btn btn-xs btn-default" type="submit">
								<i class="fa fa-times"></i>
								Eliminar
							</button>
						{{Form::close()}}

						<div class="formbutton">
							<a class="btn btn-xs btn-success" href="{{URL::to('/pedidos/'.$cliente->id.'/nuevo')}}">
								<i class="fa fa-pencil-square-o"></i>
								Procesar nuevo pedido
							</a>
						</div>



					</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination->links()}}

			<hr>

			<h3><b>Listado de pedidos realizados</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td><b>Cliente</b></td>
					<td><b>Productos</b></td>
					<td><b>Monto del pedido</b></td>

					<td><b>Opciones</b></td>
				</tr>
				@foreach($pagination2=Pedido::paginate(10) as $pedido)
				<tr>
					<td><small> {{Cliente::getInf($pedido->cliente)->nombre}}
					{{Cliente::getInf($pedido->cliente)->apellido}} </small></td>
					<td><small>
						@foreach(explode(',', $pedido->productos) as $producto)
							<?php $pp = explode(':', $producto); ?>
							<div class="label label-success">
								{{Producto::getInf($pp[0])->nombre}}
							</div>
						@endforeach
					</small></td>
					<td><small> {{$pedido->total}} </small></td>

					<td><small>

						{{Form::open(['method'=>'DELETE', 'url'=>'/pedidos/'.$pedido->id, 'class'=>'formbutton'])}}
							<button class="btn btn-xs btn-default" type="submit">
								<i class="fa fa-times"></i>
								Eliminar
							</button>
						{{Form::close()}}

					</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination2->links()}}

			<a href="{{URL::to('/clientes/create')}}" class="btn btn-success btn-xs">Crear nuevo cliente</a>
		</div>
	</div>
	</div>
@stop