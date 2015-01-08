<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('firstname', 120);
			$table->string('lastname', 120);
			$table->string('email', 100)->unique();
			$table->string('password', 64);
			$table->boolean('unregistered')->default(false);
            $table->string('confirmation_code')->nullable();
            $table->string('remember_token',255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
