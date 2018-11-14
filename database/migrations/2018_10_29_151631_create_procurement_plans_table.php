<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcurementPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procurement_plans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_managements_id')->unsigned()->index()->comment('供应商id');
			$table->integer('product_good_id')->unsigned()->index()->comment('采购产品id');
			$table->integer('product_id')->unsigned()->index()->comment('采购产品id');
			$table->enum('procurement_type', array('procurement','test'))->default('procurement')->comment('采购类型');
			$table->enum('product_colour', array('new','good','bad'))->default('new')->comment('产品成色');
			$table->enum('procurement_status', array('procurement','finish','unfinished'))->default('procurement')->comment('采购入库状态');
			$table->string('serial_number')->comment('序列号');
			$table->integer('procurement_number')->unsigned()->comment('采购数量');
			$table->integer('finish_procurement_number')->unsigned()->nullable()->default(0)->comment('已采购数量');
			$table->integer('quality_time')->unsigned()->nullable()->comment('质保时间');
			$table->string('postscript', 400)->nullable()->comment('备注信息');
			$table->string('logistics_company')->nullable()->comment('物流公司');
			$table->string('logistics_number')->nullable()->comment('物流单号');
			$table->integer('admin')->unsigned()->comment('操作人员');
			$table->integer('purchase')->unsigned()->comment('采购人员');
			$table->text('code')->nullable()->comment('条码');
			$table->text('two_code')->nullable()->comment('二级条码');
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
		Schema::drop('procurement_plans');
	}

}
