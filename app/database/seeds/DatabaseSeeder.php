<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
	}

}


class UsersTableSeeder extends Seeder {
	public function run()
	{
		DB::table('users')->insert(array(
			'id'				=> 1,
		    'nombre' 	        => 'Andres',
		    'apellido'			=> 'Gazman',
		    'email'             => '123@gmail.com',
		    'password'          => Hash::make('123456'),
		    'rol'               => 0
		));

		DB::table('marcas')->insert(array(
			'id'				=> 1,
		    'nombre' 	        => 'Andromeda',
		    'url'				=> '#',
		    'imagen' 			=> '#',
		));

		DB::table('proveedores')->insert(array(
			'id'				=> 1,
		    'nombre' 	        => 'Jupiter C.A',
		    'representante'		=> 'Juan Martinez',
		    'telefono' 			=> '04148563241',
		));

		DB::table('productos')->insert(array(
			'id'				=> 1,
		    'nombre' 	        => 'Silla Andromeda Z30',
		    'modelo'		    => 'Ejecutiva',
		    'descripcion' 	    => 'Silla de alta gama deportiva',
		    'monto' 			=> 1000,
		    'cantidad' 			=> 230,
		    'marca_id' 			=> 1,
		    'proveedor_id' 	    => 1,
		));

		DB::table('productos')->insert(array(
			'id'				=> 2,
		    'nombre' 	        => 'Silla POLMEX',
		    'modelo'		    => 'Ejecutiva',
		    'descripcion' 	    => 'Silla de alta gama deportiva',
		    'monto' 			=> 1650,
		    'cantidad' 			=> 123,
		    'marca_id' 			=> 1,
		    'proveedor_id' 	    => 1,
		));

		DB::table('clientes')->insert(array(
			'id'				=> 1,
		    'nombre' 	        => 'Carmen Gonzalez',
		    'cedula'		    => 22800114,
		    'rif' 	            => '',
		    'direccion'         => 'Urb vista hermosa, bloque 3b, carrera sur diagonal a la bodega',
		    'telefono' 			=> '04145863456'
		));
	}

}

