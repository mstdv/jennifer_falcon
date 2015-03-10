@extends('index')
@section('title')
	Cambiar informacion de producto
@stop
@section('cont')
<div class="container">
	<div class="row">
	<div class="col-lg-12">
			@if ($errors->has())
				@foreach ($errors->all() as $error)
					<div class="alert alert-warning">
						{{$error}}
					</div>
				@endforeach
			@endif
	</div>

		{{ Form::open(array('url' => '/productos/'.$producto->id, 'method' => 'PUT')) }}
		<div class="col-lg-6">
			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			{{ Form::label('nombre', 'Nombre:', ['class' => 'label label-default']) }}
			{{ Form::text('nombre', $producto->nombre, ['class' => 'form-control']) }}

			{{ Form::label('modelo', 'Modelo:', ['class' => 'label label-default']) }}
			{{ Form::text('modelo', $producto->modelo, ['class' => 'form-control']) }}

			{{ Form::label('descripcion', 'Descripcion:', ['class' => 'label label-default']) }}
			{{ Form::text('descripcion', $producto->descripcion, ['class' => 'form-control']) }}

			{{ Form::label('cantidad', 'Cantidad:', ['class' => 'label label-default']) }}
			{{ Form::text('cantidad', $producto->cantidad, ['class' => 'form-control']) }}

		</div>
		<div class="col-lg-6">

			{{ Form::label('monto', 'Monto:', ['class' => 'label label-default']) }}
			{{ Form::text('monto', $producto->monto, ['class' => 'form-control']) }}

			{{ Form::label('marca', 'Marca:', ['class' => 'label label-default']) }}
			<select name="marca_id" class="form-control">

				<option value="{{$producto->marca_id}}" selected="true">
					{{Marca::getInf($producto->marca_id)->nombre}}
				</option>

				@foreach(Marca::get() as $marca)
					<option value="{{$marca->id}}">{{$marca->nombre}}</option>
				@endforeach
			</select>

			{{ Form::label('proveedor', 'Proveedor:', ['class' => 'label label-default']) }}
			<select name="proveedor_id" class="form-control">

				<option value="{{$producto->proveedor_id}}" selected="true">
					{{Proveedor::getInf($producto->proveedor_id)->nombre}}
				</option>

				@foreach(Proveedor::get() as $proveedor)
					<option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
				@endforeach
			</select>

		</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<br>
				<button class="btn btn-success btn-block">Cambiar informacion de producto</button>
				{{ Form::close() }}

			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
		</div>
</div>
@stop