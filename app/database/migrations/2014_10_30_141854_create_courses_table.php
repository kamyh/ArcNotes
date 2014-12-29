<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name', 120);
            $table->integer('id_class')->unsigned();
			$table->timestamps();
			$table->string('matter', 120);
            $table->unique(array('id_class','name','matter'));
        });

        Schema::table('courses', function($table) {
            $table->foreign('id_class')->references('id')->on('classes')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
