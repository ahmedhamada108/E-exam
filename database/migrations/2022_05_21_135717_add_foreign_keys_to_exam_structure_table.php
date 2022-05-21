<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExamStructureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exam_structure', function(Blueprint $table)
		{
			$table->foreign('chapter_id', 'chapter_id_ibfk_3')->references('id')->on('chapters')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('exam_id', 'exam_id_ibfk_1')->references('id')->on('exams')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('model_type_id', 'model_type_id_ibfk_3')->references('id')->on('model_type')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exam_structure', function(Blueprint $table)
		{
			$table->dropForeign('chapter_id_ibfk_3');
			$table->dropForeign('exam_id_ibfk_1');
			$table->dropForeign('model_type_id_ibfk_3');
		});
	}

}
