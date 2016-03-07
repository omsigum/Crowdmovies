<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('updates', function(Blueprint $table)
		{
			$table->foreign('submissionID', 'updates_ibfk_1')->references('ID')->on('submission')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('updates', function(Blueprint $table)
		{
			$table->dropForeign('updates_ibfk_1');
		});
	}

}
