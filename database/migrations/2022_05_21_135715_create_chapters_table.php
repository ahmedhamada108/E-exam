<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chapters', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name_ar');
			$table->string('name_en');
			$table->integer('subject_id')->index('subjects_id_ibfk_1');
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
		Schema::drop('chapters');
	}

}
