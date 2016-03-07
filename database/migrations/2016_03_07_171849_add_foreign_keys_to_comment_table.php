<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comment', function(Blueprint $table)
		{
			$table->foreign('submissionID', 'comment_ibfk_1')->references('ID')->on('submission')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('userID', 'comment_ibfk_2')->references('ID')->on('user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comment', function(Blueprint $table)
		{
			$table->dropForeign('comment_ibfk_1');
			$table->dropForeign('comment_ibfk_2');
		});
	}

}
