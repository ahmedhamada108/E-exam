<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mcq', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('question_name');
			$table->string('correct_answer');
			$table->boolean('Is_TrueFalse')->default(0);
			$table->integer('subject_id')->index('subject_id_ibfk_1');
			$table->integer('model_type_id')->index('model_type_id_ibfk_1');
			$table->integer('chapter_id')->index('chapter_id_ibfk_1');
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
		Schema::drop('mcq');
	}

}
