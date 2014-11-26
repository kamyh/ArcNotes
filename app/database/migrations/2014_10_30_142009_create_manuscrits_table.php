<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManuscritsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('manuscrits', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->timestamps();
			$table->integer('id_basenotes')->references('id')->on('basenotes');
            $table->text('content');
            $table->text('title');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('manuscrits');
	}

}
