<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCorrectAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('correct_answer', function(Blueprint $table)
		{
			$table->foreign('mcq_id', 'mcq_id_ibfk_1')->references('id')->on('mcq')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('correct_answer', function(Blueprint $table)
		{
			$table->dropForeign('mcq_id_ibfk_1');
		});
	}

}
