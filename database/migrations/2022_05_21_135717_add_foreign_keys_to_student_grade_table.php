<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentGradeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_grade', function(Blueprint $table)
		{
			$table->foreign('exam_id', 'exam_id_idk32')->references('id')->on('exams')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('student_id', 'stuent_id_idk3')->references('id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_grade', function(Blueprint $table)
		{
			$table->dropForeign('exam_id_idk32');
			$table->dropForeign('stuent_id_idk3');
		});
	}

}
