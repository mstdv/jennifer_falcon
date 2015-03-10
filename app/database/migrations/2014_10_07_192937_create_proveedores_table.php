<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedoresTable extends Migration {

	public function up()
	{
		Schema::create('proveedores', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nombre', 300)->default('Sin valor');
			$table->string('representante', 300)->default('Sin valor');
			$table->string('telefono', 20)->default('0');
		});
	}

	public function down()
	{
		Schema::drop('proveedores');
	}
}