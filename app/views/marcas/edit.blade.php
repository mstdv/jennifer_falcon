@extends('index')
@section('title')
	Modificar marca
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

		{{ Form::open(array('url' => '/marcas/'.$marca->id, 'method' => 'PUT', 'files' => true)) }}
		<div class="col-lg-6">
			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			{{ Form::label('nombre', 'Nombre:', ['class' => 'label label-default']) }}
			{{ Form::text('nombre', $marca->nombre, ['class' => 'form-control']) }}

			{{ Form::label('url', 'Url:', ['class' => 'label label-default']) }}
			{{ Form::text('url', $marca->url, ['class' => 'form-control']) }}

			<br>
			{{ Form::file('img') }}

		</div>
		<div class="col-lg-6">


		</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<br>
				<button class="btn btn-success btn-block">Guardar Cambios para la marca: {{$marca->nombre}}</button>
				{{ Form::close() }}

			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
		</div>
	</div>
@stop