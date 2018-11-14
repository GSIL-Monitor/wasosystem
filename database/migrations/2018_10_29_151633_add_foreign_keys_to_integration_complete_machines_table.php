<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIntegrationCompleteMachinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('integration_complete_machines', function(Blueprint $table)
		{
			$table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('integration_id')->references('id')->on('integrations')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('integration_complete_machines', function(Blueprint $table)
		{
			$table->dropForeign('integration_complete_machines_complete_machine_id_foreign');
			$table->dropForeign('integration_complete_machines_integration_id_foreign');
		});
	}

}
