<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarcodeAssociatedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barcode_associateds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_managements_id')->unsigned()->nullable()->default(0)->index()->comment('供应商id');
			$table->integer('user_id')->unsigned()->nullable()->default(0)->index()->comment('收货单位');
			$table->integer('order_id')->unsigned()->nullable()->default(0)->index()->comment('订单id');
			$table->integer('procurement_plans_id')->unsigned()->nullable()->default(0)->index()->comment('入库id');
			$table->integer('warehouse_out_management_id')->unsigned()->nullable()->default(0)->index()->comment('出库id');
			$table->integer('product_good_id')->unsigned()->index()->comment('产品id');
			$table->string('code')->index()->comment('条码');
			$table->string('two_code')->nullable()->index()->comment('二级条码');
			$table->string('current_state')->nullable()->comment('当前状态');
			$table->enum('product_colour', array('new','good','bad'))->default('new')->comment('产品成色');
			$table->string('postscript', 400)->nullable()->comment('备注信息');
			$table->string('description')->nullable()->comment('描述');
			$table->string('location')->nullable()->comment('归属地');
			$table->boolean('associated_disposal')->default(0)->comment('关联处理');
			$table->integer('admin')->unsigned()->comment('操作人员');
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
		Schema::drop('barcode_associateds');
	}

}
