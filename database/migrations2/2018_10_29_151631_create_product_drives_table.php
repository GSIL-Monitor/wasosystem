<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductDrivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_drives', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_frame_works_id')->unsigned()->nullable()->index();
			$table->integer('product_good_id')->unsigned()->nullable()->index();
			$table->text('file')->nullable();
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
		Schema::drop('product_drives');
	}

}
