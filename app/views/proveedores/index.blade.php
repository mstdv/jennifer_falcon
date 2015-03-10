@extends('index')
@section('title')
	Proveedores
@stop
@section('cont')
<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
	</style>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3><b>Listado de proveedores</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="220px;"><b>Nombre</b></td>
					<td width="120px;"><b>Representante</b></td>
					<td width="90px;"><b>Telefono</b></td>
					<td><b>Opciones</b></td>
				</tr>
				@foreach($pagination=Proveedor::paginate(10) as $proveedor)
				<tr>
					<td><small> {{$proveedor->nombre}} </small></td>
					<td><small> {{$proveedor->representante}} </small></td>
					<td><small> {{$proveedor->telefono}} </small></td>

					<td><small>
						<div class="formbutton">
							<a class="btn btn-xs btn-default" href="{{URL::to('/proveedores/'.$proveedor->id.'/edit')}}">
								<i class="fa fa-pencil-square-o"></i>
								Modificar
							</a>
						</div>


						{{Form::open(['method'=>'DELETE', 'url'=>'/proveedores/'.$proveedor->id, 'class'=>'formbutton'])}}
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
			<a href="{{URL::to('/proveedores/create')}}" class="btn btn-success btn-xs">Crear nuevo proveedor</a>
		</div>
	</div>
	</div>
@stop