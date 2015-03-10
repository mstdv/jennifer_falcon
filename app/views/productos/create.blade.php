@extends('index')
@section('title')
	Registrar Producto
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

		{{ Form::open(array('url' => '/productos', 'method' => 'POST')) }}
		<div class="col-lg-6">
			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			{{ Form::label('nombre', 'Nombre:', ['class' => 'label label-default']) }}
			{{ Form::text('nombre', '', ['class' => 'form-control']) }}

			{{ Form::label('modelo', 'Modelo:', ['class' => 'label label-default']) }}
			{{ Form::text('modelo', '', ['class' => 'form-control']) }}

			{{ Form::label('descripcion', 'Descripcion:', ['class' => 'label label-default']) }}
			{{ Form::text('descripcion', '', ['class' => 'form-control']) }}

			{{ Form::label('cantidad', 'Cantidad:', ['class' => 'label label-default']) }}
			{{ Form::text('cantidad', '', ['class' => 'form-control']) }}


		</div>
		<div class="col-lg-6">

			{{ Form::label('monto', 'Monto:', ['class' => 'label label-default']) }}
			{{ Form::text('monto', '', ['class' => 'form-control']) }}

			{{ Form::label('marca', 'Marca:', ['class' => 'label label-default']) }}
			<select name="marca_id" class="form-control">
				@foreach(Marca::get() as $marca)
					<option value="{{$marca->id}}">{{$marca->nombre}}</option>
				@endforeach
			</select>

			{{ Form::label('proveedor', 'Proveedor:', ['class' => 'label label-default']) }}
			<select name="proveedor_id" class="form-control">
				@foreach(Proveedor::get() as $proveedor)
					<option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
				@endforeach
			</select>

		</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<br>
				<button class="btn btn-success btn-block">Regitrar nuevo producto</button>
				{{ Form::close() }}

			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
		</div>
</div>
@stop