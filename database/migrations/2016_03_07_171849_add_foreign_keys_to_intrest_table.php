<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIntrestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('intrest', function(Blueprint $table)
		{
			$table->foreign('submissionID', 'intrest_ibfk_1')->references('ID')->on('submission')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('userID', 'intrest_ibfk_2')->references('ID')->on('user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('intrest', function(Blueprint $table)
		{
			$table->dropForeign('intrest_ibfk_1');
			$table->dropForeign('intrest_ibfk_2');
		});
	}

}
