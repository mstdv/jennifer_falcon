@extends('index')
@section('title')
	Emitir reportes
@stop
@section('cont')
	<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
	</style>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3><b>Reporte de pedidos</b></h3>
			<hr>
			<div class="col-lg-12">
					@if ($errors->has())
						@foreach ($errors->all() as $error)
							<div class="alert alert-warning">
								{{$error}}
							</div>
						@endforeach
					@endif
			</div>

		<div class="row">

		{{ Form::open(array('url' => '/reporte', 'method' => 'POST')) }}

			<style>
				.label { margin-bottom: 10px; margin-top: 10px; display: inline-block; font-size: 13px; }
				.label-default { background-color: transparent; color: #454545; padding: 0; }
				.fa { margin-right: 5px; }
			</style>

			<div class="col-lg-3">
			{{ Form::label('f1', 'Fecha inicial del reporte:', ['class' => 'label label-default']) }}
			{{ Form::text('f1', '', ['class' => 'form-control datepicker']) }}
			</div>

			<div class="col-lg-3">
			{{ Form::label('f2', 'Fecha inicial del reporte:', ['class' => 'label label-default']) }}
			{{ Form::text('f2', '', ['class' => 'form-control', 'id' => 'datepicker']) }}
			</div>

			<div class="col-lg-12">
			<hr>
			<button class="btn btn-success">Generar Nuevo Reporte</button>
			</div>
		{{ Form::close() }}

		</div>

		</div>
	</div>
	</div>
@stop