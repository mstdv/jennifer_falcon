@extends('index')

@section('title')
	Back Up
@stop

@section('cont')

	<div class="container">
		@foreach($respaldos as $r)

			@if($r != "." && $r != "..")

				<a href="descarga/{{$r}}" target="_blank">{{$r}}</a><br />

			@endif

		@endforeach
	</div>

@stop