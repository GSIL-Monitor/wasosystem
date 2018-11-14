<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplierManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplier_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->index()->comment('简称');
			$table->string('code')->index()->comment('简码');
			$table->string('linkman')->nullable()->comment('联系人');
			$table->string('phone')->nullable()->comment('联系电话');
			$table->string('address')->nullable()->comment('联系地址');
			$table->string('admin')->comment('采购人员');
			$table->timestamps();
			$table->integer('sales_return_count')->unsigned()->nullable()->default(0)->comment('退货数量');
			$table->integer('factory_return_count')->unsigned()->nullable()->default(0)->comment('返厂数量');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('supplier_managements');
	}

}
