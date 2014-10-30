<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssocclassuserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assocclassuser', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('id_class')->references('id')->on('classes');
			$table->integer('id_user')->reference('id')->on('users');
			$table->unique('id_class','id_user');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assocclassuser');
	}

}
