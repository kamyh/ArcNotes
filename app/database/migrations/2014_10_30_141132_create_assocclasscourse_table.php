<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssocclasscourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assocclasscourse', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('id_class')->references('id')->on('classes');
			$table->integer('id_course')->reference('id')->on('courses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assocclasscourse');
	}

}
