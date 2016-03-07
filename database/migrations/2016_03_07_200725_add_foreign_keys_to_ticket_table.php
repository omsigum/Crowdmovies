<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->foreign('userID', 'ticket_ibfk_1')->references('ID')->on('user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('submissionID', 'ticket_ibfk_2')->references('ID')->on('submission')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->dropForeign('ticket_ibfk_1');
			$table->dropForeign('ticket_ibfk_2');
		});
	}

}
