<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompleteMachinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complete_machines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->index()->comment('产品型号');
			$table->string('code', 300)->comment('配置代码');
			$table->text('price')->comment('产品价格');
			$table->enum('float', array('come-up','lower','smooth'))->nullable()->default('smooth')->comment('价格浮动');
			$table->enum('marketing', array('none','new','hot','moods','sale'))->default('none')->comment('营销');
			$table->text('status')->nullable()->comment('产品状态');
			$table->integer('quality_time')->nullable()->index()->comment('质保时间');
			$table->integer('weight')->nullable()->comment('重量');
			$table->text('jiagou')->nullable()->comment('架构类型');
			$table->text('additional_arguments')->nullable()->comment('额外参数');
			$table->text('application')->nullable()->comment('应用类型');
			$table->integer('sales_volume')->nullable()->default(0)->comment('销量');
			$table->integer('parent_id')->nullable()->default(0)->comment('所属产品');
			$table->text('details', 65535)->nullable()->comment('产品详情');
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
		Schema::drop('complete_machines');
	}

}
