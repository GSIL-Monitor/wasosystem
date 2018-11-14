<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInformationCompleteMachinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('information_complete_machines', function(Blueprint $table)
		{
			$table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('information_management_id')->references('id')->on('information_managements')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('information_complete_machines', function(Blueprint $table)
		{
			$table->dropForeign('information_complete_machines_complete_machine_id_foreign');
			$table->dropForeign('information_complete_machines_information_management_id_foreign');
		});
	}

}
