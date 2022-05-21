<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exams', function(Blueprint $table)
		{
			$table->foreign('prof_id', 'prof_ibfk_1')->references('id')->on('professors')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('subject_id', 'subject_ibfk_2')->references('id')->on('subjects')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exams', function(Blueprint $table)
		{
			$table->dropForeign('prof_ibfk_1');
			$table->dropForeign('subject_ibfk_2');
		});
	}

}
