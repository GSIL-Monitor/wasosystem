<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIntegrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('integrations', function(Blueprint $table)
		{
			$table->foreign('parent_id')->references('id')->on('integration_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('integrations', function(Blueprint $table)
		{
			$table->dropForeign('integrations_parent_id_foreign');
		});
	}

}
