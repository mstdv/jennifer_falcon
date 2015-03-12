<?php

	Route::get('/', 'HomeController@index');

	Route::group(['before' => 'guest'], function(){

		Route::get('/login', ['before' => 'guest', 'uses' => 'HomeController@login']);
		Route::post('/login', ['before' => 'guest', 'uses' => 'HomeController@postlogin']);

	});

	Route::group(['before' => 'auth'], function(){

		Route::get('logout', ['before' => 'auth', 'uses' => 'HomeController@backlogin']);

		Route::resource('users', 'UsersController');
		Route::post('/users/cs/{id}', 'UsersController@changeState');
		Route::post('/users/deleteall', 'UsersController@deleteAll');
		Route::get('exportar', 'UsersController@exportar');

		Route::resource('clientes', 'ClientesController');
		Route::resource('proveedores', 'ProveedoresController');
		Route::resource('marcas', 'MarcasController');
		Route::resource('productos', 'ProductosController');
		Route::resource('pedidos', 'PedidosController');

		Route::get('/pedidos/{id}/nuevo', 'PedidosController@nuevoPedido');
		Route::get('/pedidos/productos/{id}', 'PedidosController@productos');
		Route::post('/pedidos/{producto_id}/{cliente_id}/agregar', 'PedidosController@agregar');
		Route::get('/pedidos/cliente/{id}', 'PedidosController@estadoIndividual');
		Route::get('/pedidos/remover/{producto}/{cliente}', 'PedidosController@removerElemento');
		Route::post('/pedidos/procesar/{cliente}', 'PedidosController@procesar');



		Route::get('inventario', 'ProductosController@inventario');
		Route::post('inventario', 'ProductosController@printInventario');

		Route::get('/reporte', 'PedidosController@reporte');
		Route::post('/reporte', 'PedidosController@reportepost');

		Route::get('descarga/{nombre}', 'UsersController@descarga');

	});
?>