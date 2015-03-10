<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarcasTable extends Migration {

	public function up()
	{
		Schema::create('marcas', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nombre', 120)->default('Sin valor');
			$table->string('url', 3000)->default('Sin valor');
			$table->string('imagen', 1200)->default('#');
		});
	}

	public function down()
	{
		Schema::drop('marcas');
	}
}