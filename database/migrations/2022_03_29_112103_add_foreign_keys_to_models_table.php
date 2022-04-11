<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToModelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('models', function(Blueprint $table)
		{
			$table->foreign('chapter_id', 'chapter_id_ibfk_1')->references('id')->on('chapters')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('model_type_id', 'model_type_id_ibfk_1')->references('id')->on('model_type')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('subject_id', 'subject_id_ibfk_1')->references('id')->on('subjects')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('models', function(Blueprint $table)
		{
			$table->dropForeign('chapter_id_ibfk_1');
			$table->dropForeign('model_type_id_ibfk_1');
			$table->dropForeign('subject_id_ibfk_1');
		});
	}

}
