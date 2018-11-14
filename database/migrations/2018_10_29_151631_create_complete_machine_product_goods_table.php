<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompleteMachineProductGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complete_machine_product_goods', function(Blueprint $table)
		{
			$table->integer('complete_machine_id')->unsigned()->index();
			$table->integer('product_good_id')->unsigned()->index();
			$table->integer('product_good_num')->unsigned()->comment('数量');
			$table->string('product_number', 2)->default('A')->index()->comment('排序');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('complete_machine_product_goods');
	}

}
