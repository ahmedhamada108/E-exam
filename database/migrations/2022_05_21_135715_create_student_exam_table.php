<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_exam', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('exam_id')->nullable()->index('exam_id_ibfk_2');
			$table->integer('student_id')->nullable()->index('student_id_ibfk');
			$table->integer('mcq_id')->nullable()->index('mcq_id_ipk4');
			$table->string('student_answer')->nullable();
			$table->string('correct_answer')->nullable();
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
		Schema::drop('student_exam');
	}

}
