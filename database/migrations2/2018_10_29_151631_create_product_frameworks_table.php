<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductFrameworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_frameworks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->comment('架构系列名');
			$table->integer('product_id')->unsigned()->index()->comment('产品id');
			$table->integer('parent_id')->unsigned()->default(0)->index()->comment('父级id');
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
		Schema::drop('product_frameworks');
	}

}
