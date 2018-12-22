<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOldGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('old_goods', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('pay_id', 50)->nullable();
			$table->string('product', 50)->nullable();
			$table->string('productid', 50)->nullable();
			$table->integer('num')->nullable();
			$table->dateTime('dt')->nullable();
			$table->string('assure_time', 50)->nullable();
			$table->string('price', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('old_goods');
	}

}
