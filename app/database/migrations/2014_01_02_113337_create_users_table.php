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
		Schema::dropIfExists('users');
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('id', 8)->primary();
            $table->string('fullname', 128);
            $table->string('password', 64);
            $table->string('email', 128);
            $table->timestamps();
		});
		
		$default_user = new User;
		$default_user->id       = 'admin';
		$default_user->fullname = 'Administrator';
		$default_user->password = Hash::make('password');
		$default_user->email    = 'admin@localhost';
		$default_user->save();
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