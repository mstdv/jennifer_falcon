@extends('index')
@section('title')
	Marcas
@stop
@section('cont')
	<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
	</style>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3><b>Listado de marcas</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="120px;"><b>Nombre</b></td>
					<td width="70px;"><b>Url</b></td>
					<td width="140px;"><b>Imagen</b></td>
					<td><b>Opciones</b></td>
				</tr>
				@foreach($pagination=Marca::paginate(10) as $marca)
				<tr>
					<td><small> {{$marca->nombre}} </small></td>
					<td><small> <a href="{{$marca->url}}">{{$marca->url}}</a> </small></td>
					<td><small> <a href="{{URL::to('/')}}/imgs/{{$marca->imagen}}">{{$marca->imagen}}</a> </small></td>

					<td><small>
						<div class="formbutton">
							<a class="btn btn-xs btn-default" href="{{URL::to('/marcas/'.$marca->id.'/edit')}}">
								<i class="fa fa-pencil-square-o"></i>
								Modificar
							</a>
						</div>


						{{Form::open(['method'=>'DELETE', 'url'=>'/marcas/'.$marca->id, 'class'=>'formbutton'])}}
							<button class="btn btn-xs btn-default" type="submit">
								<i class="fa fa-times"></i>
								Eliminar
							</button>
						{{Form::close()}}

					</small></td>
				</tr>
				@endforeach
			</table>
			{{$pagination->links()}}

			<a href="{{URL::to('/marcas/create')}}" class="btn btn-xs btn-success">Registrar nueva Marcas</a>
		</div>
	</div>
	</div>
@stop