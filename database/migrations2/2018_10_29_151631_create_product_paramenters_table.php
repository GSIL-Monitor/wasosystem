<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductParamentersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_paramenters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->index()->comment('参数名');
			$table->string('danwei', 30)->nullable()->comment('单位');
			$table->enum('type', array('input','select','checkbox','radio'))->default('input')->comment('显示类型');
			$table->enum('show_type', array('framework','series','goods','paramenters'))->default('framework')->comment('指定参数');
			$table->boolean('qiantai_show')->default(1)->comment('前台是否显示');
			$table->boolean('admin_show')->default(1);
			$table->integer('order')->nullable()->default(50)->comment('排序');
			$table->integer('product_id')->unsigned()->index()->comment('专有项的产品id');
			$table->integer('parent_id')->unsigned()->default(0)->index()->comment('专有项子参数的父级id');
			$table->integer('parameter_pid')->unsigned()->default(0)->index()->comment('指定的父级参数');
			$table->integer('parameter_id')->unsigned()->default(0)->index()->comment('指定的参数');
			$table->integer('oid')->unsigned()->default(0)->index()->comment('指定的参数');
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
		Schema::drop('product_paramenters');
	}

}
