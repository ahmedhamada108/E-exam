<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subjects', function(Blueprint $table)
		{
			$table->foreign('dept_id', 'dept_id_ibfk_1')->references('id')->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('level_id', 'level_id_ibfk_1')->references('id')->on('levels')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('prof_id', 'prof_id_ibfk_1')->references('id')->on('professors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subjects', function(Blueprint $table)
		{
			$table->dropForeign('dept_id_ibfk_1');
			$table->dropForeign('level_id_ibfk_1');
			$table->dropForeign('prof_id_ibfk_1');
		});
	}

}
