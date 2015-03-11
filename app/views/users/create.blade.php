@extends('index')
@section('title')
	Registrar Usuario
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

		{{ Form::open(array('url' => '/users', 'method' => 'POST')) }}
		<div class="col-lg-6">
			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			{{ Form::label('nombre', 'Nombre:', ['class' => 'label label-default']) }}
			{{ Form::text('nombre', '', ['class' => 'form-control']) }}

			{{ Form::label('apellido', 'Apellido:', ['class' => 'label label-default']) }}
			{{ Form::text('apellido', '', ['class' => 'form-control']) }}


		</div>
		<div class="col-lg-6">

			{{ Form::label('password', 'Password:', ['class' => 'label label-default']) }}
			{{ Form::password('password', ['class' => 'form-control']) }}

			{{ Form::label('email', 'Email:', ['class' => 'label label-default']) }}
			{{ Form::text('email', '', ['class' => 'form-control']) }}

		</div>
		<div class="col-lg-6 col-lg-offset-3">
			{{ Form::select("rol", [
				"0" => "Administrador",
				"1" => "Usuario"
			], '', ["class" => "form-control"]) }}
		</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<br>
				<button class="btn btn-success btn-block">Agregar</button>
				{{ Form::close() }}

			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
		</div>

	</div>
@stop