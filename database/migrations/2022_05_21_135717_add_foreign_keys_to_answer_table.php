<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answer', function(Blueprint $table)
		{
			$table->foreign('mcq_id', 'mcq_id_ibfk_2')->references('id')->on('mcq')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('answer', function(Blueprint $table)
		{
			$table->dropForeign('mcq_id_ibfk_2');
		});
	}

}
