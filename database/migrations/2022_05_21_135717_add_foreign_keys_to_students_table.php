<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			$table->foreign('dept_id', 'dept_id_student')->references('id')->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('level_id', 'level_id_student')->references('id')->on('levels')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table)
		{
			$table->dropForeign('dept_id_student');
			$table->dropForeign('level_id_student');
		});
	}

}
