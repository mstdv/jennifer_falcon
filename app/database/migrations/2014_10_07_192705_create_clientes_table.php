<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nombre', 220)->default('Sin valor');
			$table->string('cedula', 20)->default('0');
			$table->string('rif', 30)->default('0');
			$table->string('direccion', 600)->default('Sin valor');
			$table->string('telefono', 20)->default('Sin valor');
		});
	}

	public function down()
	{
		Schema::drop('clientes');
	}
}