<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array('about','honor','service_directory','job','copyright','banner','friend'))->index()->comment('分类');
			$table->integer('sort')->unsigned()->default(50)->comment('排序');
			$table->boolean('top')->default(0)->comment('置顶');
			$table->text('pic')->nullable()->comment('图片');
			$table->text('field')->nullable()->comment('需要的字段');
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
		Schema::drop('business_managements');
	}

}
