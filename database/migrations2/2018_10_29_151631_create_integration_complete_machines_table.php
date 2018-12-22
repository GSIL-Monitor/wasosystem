<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntegrationCompleteMachinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('integration_complete_machines', function(Blueprint $table)
		{
			$table->integer('integration_id')->unsigned()->index();
			$table->integer('complete_machine_id')->unsigned()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('integration_complete_machines');
	}

}
