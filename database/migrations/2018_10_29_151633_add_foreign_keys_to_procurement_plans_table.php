<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProcurementPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('procurement_plans', function(Blueprint $table)
		{
			$table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('supplier_managements_id')->references('id')->on('supplier_managements')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('procurement_plans', function(Blueprint $table)
		{
			$table->dropForeign('procurement_plans_product_good_id_foreign');
			$table->dropForeign('procurement_plans_product_id_foreign');
			$table->dropForeign('procurement_plans_supplier_managements_id_foreign');
		});
	}

}
