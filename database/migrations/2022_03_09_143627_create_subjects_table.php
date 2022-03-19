<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subjects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name_ar');
			$table->string('name_en');
			$table->integer('level_id')->index('level_id_ibfk_1');
			$table->integer('dept_id')->index('dept_id_ibfk_1');
			$table->integer('prof_id')->index('prof_id_ibfk_1');
			$table->timestamps(6);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subjects');
	}

}
