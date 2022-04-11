<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTrueFalseMcqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('true_false_mcq', function(Blueprint $table)
		{
			$table->foreign('model_id', 'model_id_ibfk_3')->references('id')->on('models')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('true_false_mcq', function(Blueprint $table)
		{
			$table->dropForeign('model_id_ibfk_3');
		});
	}

}
