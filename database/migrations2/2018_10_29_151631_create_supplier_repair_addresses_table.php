<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierRepairAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplier_repair_addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_managements_id')->unsigned()->index();
			$table->string('name')->comment('售后人员');
			$table->string('phone')->nullable()->comment('联系电话');
			$table->string('email')->nullable()->comment('联系邮箱');
			$table->string('address')->nullable()->comment('联系地址');
			$table->string('admin')->comment('操作人员');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('supplier_repair_addresses');
	}

}
