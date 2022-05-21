<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_exam', function(Blueprint $table)
		{
			$table->foreign('exam_id', 'exam_id_ibfk_2')->references('id')->on('exams')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('mcq_id', 'mcq_id_ipk4')->references('id')->on('mcq')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('student_id', 'student_id_ibfk')->references('id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_exam', function(Blueprint $table)
		{
			$table->dropForeign('exam_id_ibfk_2');
			$table->dropForeign('mcq_id_ipk4');
			$table->dropForeign('student_id_ibfk');
		});
	}

}
