<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->timestamps();
			$table->string('name', 120);
			$table->integer('id_school')->references('id')->on('schools');
			$table->string('scollaryear',120);
			$table->string('degree',120);
			$table->
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classes');
	}

}
