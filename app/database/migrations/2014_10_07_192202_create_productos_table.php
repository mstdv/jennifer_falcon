<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductosTable extends Migration {

	public function up()
	{
		Schema::create('productos', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nombre', 70)->unique()->default('Sin valor');
			$table->string('modelo', 20)->default('Sin valor');
			$table->string('descripcion', 1200)->default('Sin valor');
			$table->float('monto', 20);
			$table->float('cantidad', 20);
			$table->integer('marca_id')->unsigned();
			$table->integer('proveedor_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('productos');
	}
}