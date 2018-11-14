<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('divisional_id')->unsigned()->index()->comment('部门管理id');
			$table->enum('task_mode', array('single','multiterm'))->default('single')->comment('任务模式');
			$table->integer('goal')->unsigned()->comment('目标任务（万）');
			$table->integer('guaranteed_task')->unsigned()->comment('保底任务（万）');
			$table->integer('award_coefficient')->unsigned()->comment('奖励系数（%）');
			$table->integer('goal_two')->unsigned()->nullable()->comment('目标任务二（万）');
			$table->integer('award_coefficient_two')->unsigned()->nullable()->comment('奖励系数二（%）');
			$table->integer('goal_three')->unsigned()->nullable()->comment('目标任务三（万）');
			$table->integer('award_coefficient_three')->unsigned()->nullable()->comment('奖励系数三（%）');
			$table->integer('punish_index')->unsigned()->nullable()->comment('处罚指标（元）');
			$table->integer('award_index')->unsigned()->nullable()->comment('奖励指标（元）');
			$table->integer('units_index')->unsigned()->nullable()->comment('单位指标（万）');
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
		Schema::drop('task_managements');
	}

}
