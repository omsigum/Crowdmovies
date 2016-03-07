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
			$table->timestamp('intresttime')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->primary(['userID','submissionID']);
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
