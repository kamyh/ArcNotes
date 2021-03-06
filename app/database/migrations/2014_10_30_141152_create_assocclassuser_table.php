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
			$table->integer('id_class')->unsigned();
			$table->integer('id_user')->unsigned();
			$table->unique(array('id_class','id_user'));
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
