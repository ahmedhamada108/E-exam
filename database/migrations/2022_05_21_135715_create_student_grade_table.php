<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGradeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_grade', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('exam_id')->index('exam_id_idk32');
			$table->integer('student_id')->index('stuent_id_idk3');
			$table->integer('exam_grade');
			$table->integer('student_grade');
			$table->timestamps(10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_grade');
	}

}
