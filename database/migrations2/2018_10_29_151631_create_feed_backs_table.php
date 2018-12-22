<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedBacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feed_backs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('称呼');
			$table->string('title')->comment('标题');
			$table->string('email')->comment('邮箱');
			$table->string('phone')->nullable()->comment('电话');
			$table->string('content')->comment('内容');
			$table->boolean('show')->default(0)->comment('内容');
			$table->text('location')->nullable()->comment('位置信息');
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
		Schema::drop('feed_backs');
	}

}
