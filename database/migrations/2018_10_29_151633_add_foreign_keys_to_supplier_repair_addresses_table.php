<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSupplierRepairAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('supplier_repair_addresses', function(Blueprint $table)
		{
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
		Schema::table('supplier_repair_addresses', function(Blueprint $table)
		{
			$table->dropForeign('supplier_repair_addresses_supplier_managements_id_foreign');
		});
	}

}
