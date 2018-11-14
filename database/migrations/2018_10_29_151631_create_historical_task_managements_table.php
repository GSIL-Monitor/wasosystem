<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoricalTaskManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historical_task_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('divisional_id')->unsigned()->index()->comment('部门管理id');
			$table->integer('goal')->unsigned()->nullable()->comment('目标任务');
			$table->integer('guaranteed_task')->unsigned()->nullable()->comment('保底任务');
			$table->integer('returned_money')->unsigned()->nullable()->comment('回款');
			$table->integer('monthly_sales')->unsigned()->nullable()->comment('月销售');
			$table->integer('outstanding')->unsigned()->nullable()->comment('发出未结');
			$table->integer('year')->unsigned()->comment('年份');
			$table->integer('mouth')->unsigned()->comment('月份');
			$table->string('punish_award')->nullable()->comment('奖惩（元）');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('historical_task_managements');
	}

}
