<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('id_user')->unsigned();
			$table->integer('id_rights');
			$table->integer('id_class')->unsigned();
            $table->increments('id')->unique();
		});

        Schema::table('permissions', function($table) {
            $table->foreign('id_class')->references('id')->on('classes')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permissions');
	}

}
