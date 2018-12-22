<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('warehouse_out_management_id')->unsigned()->index()->comment('出库id');
			$table->integer('product_good_id')->unsigned()->index()->comment('产品id');
			$table->integer('product_good_num')->unsigned()->comment('产品数量');
			$table->string('product_good_number', 10)->comment('产品编号');
			$table->text('code')->nullable()->comment('条码');
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
		Schema::drop('codes');
	}

}
