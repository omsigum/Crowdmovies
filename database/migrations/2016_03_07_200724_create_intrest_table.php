<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntrestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('intrest', function(Blueprint $table)
		{
			$table->char('userID', 36);
			$table->char('submissionID', 36)->index('submissionID');
			$table->primary(['userID','submissionID']);
			$table->timestamp('updated_at');
			$table->timestamp('created_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('intrest');
	}

}
