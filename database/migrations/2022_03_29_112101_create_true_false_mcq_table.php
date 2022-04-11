<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrueFalseMcqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('true_false_mcq', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('model_id')->index('model_id_ibfk_3');
			$table->string('question_name');
			$table->string('correct_answer');
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
		Schema::drop('true_false_mcq');
	}

}
