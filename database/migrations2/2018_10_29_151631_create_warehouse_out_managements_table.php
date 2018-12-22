<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWarehouseOutManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('warehouse_out_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->comment('收货单位');
			$table->integer('order_id')->unsigned()->nullable()->default(0)->index()->comment('订单id');
			$table->enum('out_type', array('sell','loan_out'))->default('sell')->comment('出库类型');
			$table->boolean('associated_disposal')->default(0)->comment('关联处理');
			$table->enum('out_status', array('finish','unfinished'))->default('unfinished')->comment('出库状态');
			$table->string('serial_number')->index()->comment('出库序号/订单序号');
			$table->integer('out_number')->unsigned()->comment('出库数量');
			$table->integer('finish_out_number')->unsigned()->nullable()->default(0)->comment('已出库数量');
			$table->integer('admin')->unsigned()->comment('操作人员');
			$table->string('postscript', 400)->nullable()->comment('备注信息');
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
		Schema::drop('warehouse_out_managements');
	}

}
