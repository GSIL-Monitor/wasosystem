<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDemandManagementOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('demand_management_orders', function(Blueprint $table)
		{
			$table->foreign('demand_management_id')->references('id')->on('demand_managements')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('order_id')->references('id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('demand_management_orders', function(Blueprint $table)
		{
			$table->dropForeign('demand_management_orders_demand_management_id_foreign');
			$table->dropForeign('demand_management_orders_order_id_foreign');
		});
	}

}
