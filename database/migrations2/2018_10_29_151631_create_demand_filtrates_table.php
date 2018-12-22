<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDemandFiltratesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('demand_filtrates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('名称');
			$table->enum('category', array('issue','answer'))->default('issue')->index()->comment('参数分类');
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
		Schema::drop('demand_filtrates');
	}

}
