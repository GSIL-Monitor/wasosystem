<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberStatusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_statuses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('名称');
			$table->string('identifying')->index()->comment('标识');
			$table->string('type', 30)->index()->comment('类型');
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
		Schema::drop('member_statuses');
	}

}
