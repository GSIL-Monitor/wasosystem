<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundsManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funds_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->comment('用户名');
			$table->enum('type', array('deposit','pay','down_payment'))->default('down_payment')->comment('金额类型');
			$table->integer('price')->unsigned()->nullable()->default(0)->comment('金额');
			$table->string('comment', 400)->nullable()->comment('备注');
			$table->integer('operate')->unsigned()->comment('操作人员');
			$table->integer('market')->unsigned()->index()->comment('销售人员');
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
		Schema::drop('funds_managements');
	}

}
