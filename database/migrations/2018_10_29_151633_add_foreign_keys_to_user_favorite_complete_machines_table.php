<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserFavoriteCompleteMachinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_favorite_complete_machines', function(Blueprint $table)
		{
			$table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_favorite_complete_machines', function(Blueprint $table)
		{
			$table->dropForeign('user_favorite_complete_machines_complete_machine_id_foreign');
			$table->dropForeign('user_favorite_complete_machines_user_id_foreign');
		});
	}

}
