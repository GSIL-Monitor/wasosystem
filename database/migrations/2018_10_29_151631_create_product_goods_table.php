<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_goods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index()->comment('产品id');
			$table->integer('jiagou_id')->unsigned()->index()->comment('产品架构id');
			$table->integer('xilie_id')->unsigned()->index()->comment('产品系列id');
			$table->string('name')->index()->comment('产品名称');
			$table->string('jiancheng')->nullable()->index()->comment('产品简称');
			$table->string('jianma')->nullable()->index()->comment('产品简码');
			$table->string('daima')->nullable()->comment('产品原厂代码');
			$table->text('price')->comment('产品级别价格');
			$table->enum('float', array('come-up','lower','smooth'))->default('smooth')->comment('价格浮动');
			$table->text('status')->comment('产品状态');
			$table->integer('quality_time')->unsigned()->nullable()->index()->comment('产品质保时间');
			$table->text('pic')->nullable()->comment('产品原图');
			$table->text('details')->nullable()->comment('产品的详细参数  这里我用json 保存');
			$table->integer('oldid')->unsigned()->nullable()->index()->comment('旧数据产品id 做数据迁移的时候使用');
			$table->timestamps();
			$table->softDeletes();
			$table->string('series_name')->index()->comment('系列名');
			$table->string('framework_name')->index()->comment('架构名');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_goods');
	}

}
