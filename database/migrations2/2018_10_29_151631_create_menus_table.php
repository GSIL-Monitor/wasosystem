<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->index()->comment('菜单名');
			$table->string('slug')->nullable()->index()->comment('简码');
			$table->text('pic')->nullable()->comment('图片/图标');
			$table->string('url')->nullable()->index()->comment('链接');
			$table->integer('order')->unsigned()->default(0)->comment('排序');
			$table->integer('parent_id')->unsigned()->default(0)->index()->comment('所属分类');
			$table->enum('cats', array('web','tiao'))->default('web')->index()->comment('所属栏目');
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
		Schema::drop('menus');
	}

}
