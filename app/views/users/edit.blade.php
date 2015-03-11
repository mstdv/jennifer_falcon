@extends('index')
@section('title')
	Editar Usuario
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

		{{ Form::open(array('url' => '/users/'.$user->id, 'method' => 'PUT')) }}
		<div class="col-lg-6">
			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			{{ Form::label('nombre', 'Nombre:', ['class' => 'label label-default']) }}
			{{ Form::text('nombre', $user->nombre, ['class' => 'form-control']) }}

			{{ Form::label('apellido', 'Apellido:', ['class' => 'label label-default']) }}
			{{ Form::text('apellido', $user->apellido, ['class' => 'form-control']) }}

		</div>
		<div class="col-lg-6">

			{{ Form::label('password', 'Password:', ['class' => 'label label-default']) }}
			{{ Form::password('password', ['class' => 'form-control']) }}


			{{ Form::label('email', 'Email:', ['class' => 'label label-default']) }}
			{{ Form::text('email', $user->email, ['class' => 'form-control']) }}

		</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<br>
				<button class="btn btn-success btn-block">Modificar usuario: {{$user->nombre}} {{$user->apellido}} </button>
				{{ Form::close() }}

			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
		</div>
	</div>
@stop