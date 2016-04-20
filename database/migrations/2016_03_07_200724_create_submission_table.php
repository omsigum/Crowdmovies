<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission', function(Blueprint $table)
		{
			$table->char('ID', 36)->primary();
			$table->char('IMDB', 9);
			$table->integer('status');
			$table->char('userID', 36);
			$table->timestamp('submitted')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('showtime')->nullable();
			$table->integer('price')->nullable();
			$table->string('moviename');
			$table->string('posterUrl');
			$table->string('imdbRating');
			$table->string('banner');
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
		Schema::drop('submission');
	}

}
