	<div class="row">
		<div class="col-lg-12">
			<h1>Agropecuaria Carutal "CoVA" F.P </h1>
			<hr>
			<h3><b>Reporte de pedidos <br> <small>
				Fecha: {{$fecha}}
			</small></b></h3>

			<hr>
			<h4>Desde: {{$f1}} hasta: {{$f2}} </h4>
			<table border="1">
				<tr>
					<td><b>Cliente</b></td>
					<td><b>Productos</b></td>
					<td><b>Cedula</b></td>
					<td><b>Direccion</b></td>
					<td><b>Telefono</b></td>
					<td><b>IVA</b></td>
					<td><b>Monto del pedido</b></td>
				</tr>
				<?php $total_acumulado = 0; ?>
				@foreach(Pedido::whereBetween('created_at', array($f1, $f2))->get() as $pedido)
				<tr>
					<td><small> {{Cliente::getInf($pedido->cliente)->nombre}}
					{{Cliente::getInf($pedido->cliente)->apellido}} </small></td>
					<td><small>
						@foreach(explode(',', $pedido->productos) as $producto)
							<?php $pp = explode(':', $producto); ?>
							<div class="label label-success">
								{{Producto::getInf($pp[0])->nombre}},
							</div>
						@endforeach
					</small></td>
					<td><small> {{Cliente::getInf($pedido->cliente)->cedula}}</small></td>
					<td><small> {{Cliente::getInf($pedido->cliente)->direccion}}</small></td>
					<td><small> {{Cliente::getInf($pedido->cliente)->telefono}}</small></td>
					<td><small> {{number_format(($pedido->total*12)/100)}} BsF. </small></td>
					<td><small> {{number_format($pedido->total)}} BsF. </small></td>
					<?php $total_acumulado = $total_acumulado + $pedido->total; ?>
				</tr>
				@endforeach
				<tr>
					<td colspan="6"></td>
					<td colspan="1">Total acumulado:  <br> {{number_format($total_acumulado)}} BsF.

					</td>
				</tr>
			</table>
		</div>
	</div>