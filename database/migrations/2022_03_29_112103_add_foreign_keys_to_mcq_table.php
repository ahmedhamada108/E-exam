<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMcqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mcq', function(Blueprint $table)
		{
			$table->foreign('model_id', 'model_id_ibfk_1')->references('id')->on('models')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mcq', function(Blueprint $table)
		{
			$table->dropForeign('model_id_ibfk_1');
		});
	}

}
