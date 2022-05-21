<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamStructureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exam_structure', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('exam_id')->index('exam_id_ibfk_1');
			$table->integer('chapter_id')->index('chapter_id_ibfk_3');
			$table->integer('model_type_id')->index('model_type_id_ibfk_3');
			$table->boolean('Is_TrueFalse')->default(0);
			$table->integer('number_quest');
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
		Schema::drop('exam_structure');
	}

}
