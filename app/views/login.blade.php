@extends('index')
@section('title')
	Inicio de Sesion
@stop
@section('cont')
<div class="container">
	<style>
		.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
		.label-default { background-color: transparent; color: #454545; padding: 0; }
		.fa { margin-right: 5px; }
	</style>

	<div class="row">
		<div class="col-lg-4"></div>

		<div class="col-lg-4">
			{{Form::open(['method'=>'POST', 'url'=>'/login'])}}

				@if ($errors->has())
					@foreach ($errors->all() as $error)
						<div class="alert alert-warning">
							{{$error}}
						</div>
					@endforeach
				@endif

				{{Form::label('email', 'Correo electronico:', ['class'=>'label label-default'])}}
				{{Form::email('email', '', ['class'=>'form-control'])}}

				{{Form::label('password', 'Contraseña:', ['class'=>'label label-default'])}}
				{{Form::password('password', ['class'=>'form-control'])}}

				<br>

				<button type="submit" class="btn btn-default btn-block">
					<i class="fa fa-share-square"></i> Iniciar Sesion
				</button>


			{{Form::close()}}
		</div>

		<div class="col-lg-4"></div>
	</div>
</div>
@stop