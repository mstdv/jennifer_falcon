@extends('index')
@section('title')
	Editar cliente
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

		{{ Form::open(array('url' => '/clientes/'.$cliente->id, 'method' => 'PUT')) }}
		<div class="col-lg-6">
			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			{{ Form::label('nombre', 'Nombre:', ['class' => 'label label-default']) }}
			{{ Form::text('nombre', $cliente->nombre, ['class' => 'form-control']) }}

			{{ Form::label('cedula', 'Cedula:', ['class' => 'label label-default']) }}
			{{ Form::text('cedula', $cliente->cedula, ['class' => 'form-control']) }}

			{{ Form::label('rif', 'Rif:', ['class' => 'label label-default']) }}
			{{ Form::text('rif', $cliente->rif, ['class' => 'form-control']) }}

			{{ Form::label('telefono', 'Telefono:', ['class' => 'label label-default']) }}
			{{ Form::text('telefono', $cliente->telefono, ['class' => 'form-control']) }}
		</div>
		<div class="col-lg-6">
			{{ Form::label('direccion', 'Direccion:', ['class' => 'label label-default']) }}
			{{ Form::textarea('direccion', $cliente->direccion, ['class' => 'form-control']) }}
		</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<br>
				<button class="btn btn-success btn-block">Guardar ccambios para el cliente: {{$cliente->nombre}}</button>
				{{ Form::close() }}

			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
		</div>
</div>
@stop