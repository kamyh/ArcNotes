<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->timestamps();
			$table->integer('id_basenotes')->unsigned();
			$table->string('path', 320);
		});

        Schema::table('files', function($table) {
            $table->foreign('id_basenotes')->references('id')->on('basenotes')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('files');
	}

}
