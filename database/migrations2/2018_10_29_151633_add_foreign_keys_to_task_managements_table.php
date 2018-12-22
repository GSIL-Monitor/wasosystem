<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_managements', function(Blueprint $table)
		{
			$table->foreign('divisional_id')->references('id')->on('divisional_managements')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_managements', function(Blueprint $table)
		{
			$table->dropForeign('task_managements_divisional_id_foreign');
		});
	}

}
