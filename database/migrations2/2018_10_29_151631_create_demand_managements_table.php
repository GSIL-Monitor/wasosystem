<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDemandManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('demand_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->comment('会员id');
			$table->integer('visitor_details_id')->unsigned()->default(0)->index()->comment('客情id');
			$table->string('demand_number')->index()->comment('需求号');
			$table->text('filtrate')->nullable()->comment('筛选');
			$table->text('collocate')->nullable()->comment('配置');
			$table->string('explain')->nullable()->comment('说明');
			$table->string('budget')->nullable()->comment('预算');
			$table->string('demand_status')->default('demand_consult')->index()->comment('需求状态');
			$table->string('customer_status')->default('initial_contact')->comment('客户状态');
			$table->string('the_next_step_program')->nullable()->comment('下一步计划');
			$table->integer('admin')->unsigned()->comment('所属管理员');
			$table->text('record', 65535)->nullable()->comment('交流记录');
			$table->string('assistant')->nullable()->comment('协助人员');
			$table->boolean('send')->default(0)->comment('是否通知');
			$table->boolean('analog_data')->default(0)->comment('模拟数据');
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
		Schema::drop('demand_managements');
	}

}
