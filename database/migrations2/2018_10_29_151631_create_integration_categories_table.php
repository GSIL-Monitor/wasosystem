<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntegrationCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('integration_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->index()->comment('名称');
			$table->text('pic')->nullable()->comment('标题图片');
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
		Schema::drop('integration_categories');
	}

}
