<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->rememberToken();
			$table->string('nombre', 60);
			$table->string('apellido', 60);
			$table->string('email')->unique();
			$table->string('password', 300);
			$table->integer('rol')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}