@extends('index')
@section('title')
	Gestion y control de usuarios
@stop
@section('cont')
<div class="container">
	<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
	</style>

	<div class="row">
		<div class="col-lg-12">
			<h3><b>Gestion de usuarios</b></h3>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td width="70px;"><b>Nombre</b></td>
					<td width="70px;"><b>Apellido</b></td>
					<td width="140px;"><b>Email</b></td>
					<td width="160px;"><b>Rol</b></td>
					<td><b>Opciones</b></td>
				</tr>
				@foreach($pagination=User::paginate(10) as $user)
				<tr>
					<td><small> {{$user->nombre}} </small></td>
					<td><small> {{$user->apellido}} </small></td>
					<td><small> {{$user->email}} </small></td>
					<td><small>
						@if($user->rol==0)
							Administrador General
						@elseif($user->rol==1)
							Usuario
						@endif
					</small></td>

					<td><small>
						<div class="formbutton">
							<a class="btn btn-xs btn-default" href="{{URL::to('/users/'.$user->id.'/edit')}}">
								<i class="fa fa-pencil-square-o"></i>
								Modificar
							</a>
						</div>


						{{Form::open(['method'=>'DELETE', 'url'=>'/users/'.$user->id, 'class'=>'formbutton'])}}
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

			<br>
			<a href="{{URL::to('/users/create')}}" class="btn btn-success btn-xs">Crear nuevo usuario</a>
		</div>
	</div>
</div>
@stop