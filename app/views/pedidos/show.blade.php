@extends('index')
@section('title')
	Estado de pedido para el usuario: {{$pedido['data']->nombre}} {{$pedido['data']->apellido}}
@stop
@section('cont')
	<style>
		.formbutton .btn { display: inline-block; float: left; margin: 3px; }
	</style>
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3>Estado de pedido para el usuario:
			<b>{{$pedido['data']->nombre}} {{$pedido['data']->apellido}}</b></h3>

			<a href="{{URL::to('/pedidos/productos/'.$pedido['data']->id)}}" class="btn btn-default">
				Continuar agregando Productos
			</a>
			<br>
			<hr>
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<td>Producto</td>
					<td>Cantidad</td>
					<td>Precio por Unidad</td>
					<td>Precio Unidad * Cantidad</td>
					<td>IVA de (Precio Unidad * Cantidad)</td>
					<td>Opciones</td>
				</tr>

				<?php
					$productos = explode(',', $pedido['productos']);
					$cantidad = count($productos);
					$total = 0;

					for ($i=0; $i < $cantidad; $i++) {
						$data = explode(':', $productos[$i]);
				?>

				<tr>
					<td style="font-size: 10px">

					{{Producto::getInf($data[0])->nombre}}</td>
					<td style="font-size: 10px">

					{{$data[1]}}</td>
					<td style="font-size: 10px">

					{{Producto::getInf($data[0])->monto}}</td>
					<td style="font-size: 10px">

					{{Producto::getInf($data[0])->monto * $data[1]}}</td>
					<td style="font-size: 10px">

					{{((Producto::getInf($data[0])->monto * $data[1])*12)/100}}</td>
					<td style="font-size: 10px">

						<a href="{{URL::to('/pedidos/remover/'.$data[0].':'.$data[1].'/'.$pedido['data']->id)}}" class="btn btn-xs btn-default">
							Remover
						</a>

					</td>
				</tr>

				<?php

					$total +=
					(Producto::getInf($data[0])->monto * $data[1]) +
					(((Producto::getInf($data[0])->monto * $data[1])*12)/100);

					}
				?>
				{{Form::open(['method'=>'POST', 'url' => '/pedidos/procesar/'.$pedido['data']->id])}}
				<tr>
					<td colspan="5">
						<div class="well">
							Para completar precione el siguiente boton.
						</div>
							<br>
							<button type="submit" class="btn btn-block btn-success">
								Procesar Pedido
							</button>

					</td>
					<td>
							<div class="well">
							<h3 style="margin-top:0;"><small>TOTAL:</small> <br>
							<b>{{$total}}</b></h3>

							</div>

					</td>
				</tr>
				{{Form::close()}}
			</table>
		</div>
	</div>
	</div>
@stop