@extends('index')
@section('title')
	Ubicacion
@stop
@section('cont')
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<img src="{{URL::to('/imgs/img.jpg')}}" alt="" class="img-responsive">
			</div>
			<div class="col-lg-9">
				<h3>Ubicacion</h3>
				<ul>
				 <li><b>PARROQUIA:</b> Vista Hermosa </li>
				 <li><b>MUNICIPIO:</b> Heres </li>
				 <li><b>LOCALIDAD:</b> Ciudad Bolívar </li>
				 <li><b>ESTADO:</b> Bolívar </li>
				</ul>
			</div>
		</div>
	</div>
@stop