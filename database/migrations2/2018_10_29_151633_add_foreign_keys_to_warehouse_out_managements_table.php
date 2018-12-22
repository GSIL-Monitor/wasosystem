<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWarehouseOutManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('warehouse_out_managements', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('warehouse_out_managements', function(Blueprint $table)
		{
			$table->dropForeign('warehouse_out_managements_user_id_foreign');
		});
	}

}
