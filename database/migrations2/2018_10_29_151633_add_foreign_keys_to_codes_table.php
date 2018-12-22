<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('codes', function(Blueprint $table)
		{
			$table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('warehouse_out_management_id')->references('id')->on('warehouse_out_managements')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('codes', function(Blueprint $table)
		{
			$table->dropForeign('codes_product_good_id_foreign');
			$table->dropForeign('codes_warehouse_out_management_id_foreign');
		});
	}

}
