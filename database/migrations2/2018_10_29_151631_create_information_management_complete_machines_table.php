<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInformationManagementCompleteMachinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('information_management_complete_machines', function(Blueprint $table)
		{
			$table->integer('information_management_id')->unsigned();
			$table->integer('complete_machine_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('information_management_complete_machines');
	}

}
