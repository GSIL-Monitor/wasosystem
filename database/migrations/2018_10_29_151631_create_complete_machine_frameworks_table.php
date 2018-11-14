<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompleteMachineFrameworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complete_machine_frameworks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order')->default(0)->comment('排序');
			$table->string('name')->comment('名称');
			$table->string('description')->nullable()->comment('描述');
			$table->enum('category', array('framework','Application','answer','filtrate','product'))->default('framework')->index()->comment('参数分类');
			$table->text('pic')->nullable()->comment('图片');
			$table->enum('select_type', array('checkbox','radio'))->nullable()->default('radio')->comment('筛选类型');
			$table->integer('child_id')->nullable()->default(0)->comment('子id  如果child_id 存在则不提供修改');
			$table->string('child_category')->nullable()->comment('子分类  如果child_category 存在则不提供修改');
			$table->integer('_lft')->unsigned()->default(0);
			$table->integer('_rgt')->unsigned()->default(0);
			$table->integer('parent_id')->unsigned()->nullable();
			$table->timestamps();
			$table->index(['_lft','_rgt','parent_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('complete_machine_frameworks');
	}

}
