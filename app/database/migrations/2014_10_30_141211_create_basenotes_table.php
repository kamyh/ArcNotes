<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasenotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basenotes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->integer('id_author')->references('id')->on('users');
            $table->integer('id_cours')->references('id')->on('courses');
			$table->string('token',255);
			$table->text('summary')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('basenotes');
	}

}
