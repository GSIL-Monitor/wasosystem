<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInventoryManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventory_managements', function(Blueprint $table)
		{
			$table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inventory_managements', function(Blueprint $table)
		{
			$table->dropForeign('inventory_managements_product_good_id_foreign');
			$table->dropForeign('inventory_managements_product_id_foreign');
		});
	}

}
