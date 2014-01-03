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
		Schema::create('users', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('email', 128);
            $table->text('password');
            $table->text('pass_dc');
            $table->timestamps();
		});
		
		$default_user = new User;
		$default_user->password = Hash::make('password');
		$default_user->pass_dc = Crypt::encrypt('password');
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