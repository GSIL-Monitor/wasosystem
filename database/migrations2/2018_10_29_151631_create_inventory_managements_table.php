<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index()->comment('配件id');
			$table->integer('product_good_id')->unsigned()->index()->comment('产品id');
			$table->integer('new')->unsigned()->nullable()->default(0)->comment('新品数量');
			$table->integer('good')->unsigned()->nullable()->default(0)->comment('良品数量');
			$table->integer('bad')->unsigned()->nullable()->default(0)->comment('坏品数量');
			$table->integer('return_factory')->unsigned()->nullable()->default(0)->comment('返厂数量');
			$table->integer('proxies')->unsigned()->nullable()->default(0)->comment('代管数量');
			$table->integer('test')->unsigned()->nullable()->default(0)->comment('测试品数量');
			$table->integer('warning')->unsigned()->nullable()->default(0)->comment('报警线数量');
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
		Schema::drop('inventory_managements');
	}

}
