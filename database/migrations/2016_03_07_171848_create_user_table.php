<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->char('ID', 36)->primary();
			$table->string('username');
			$table->string('name');
			$table->string('email');
			$table->string('hash');
			$table->char('salt', 21);
			$table->timestamp('registered')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->binary('verified', 1)->nullable();
			$table->integer('state')->nullable()->index('state');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
