<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultrightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defaultrights', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('id_class')->references('id')->on('classes');
			$table->integer('id_rights')->references('id')->on('rights');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('defaultrights');
	}

}
