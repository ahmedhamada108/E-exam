<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('exam_name');
			$table->integer('subject_id')->index('subject_ibfk_2');
			$table->integer('prof_id')->index('prof_ibfk_1');
			$table->boolean('Is_available')->default(0);
			$table->integer('start_at')->nullable();
			$table->integer('duration')->nullable();
			$table->integer('end_at')->nullable();
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
		Schema::drop('exams');
	}

}
