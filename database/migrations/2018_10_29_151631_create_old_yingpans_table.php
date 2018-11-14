<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOldYingpansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('old_yingpans', function(Blueprint $table)
		{
			$table->integer('id')->nullable();
			$table->string('diskid', 64)->nullable();
			$table->string('userid', 50)->nullable();
			$table->string('nums', 8)->nullable();
			$table->string('raid_m', 64)->nullable();
			$table->string('arrayid', 64)->nullable();
			$table->string('a_mode', 64)->nullable();
			$table->string('d_type', 64)->nullable();
			$table->string('diskprice', 50)->nullable();
			$table->string('arrayprice', 50)->nullable();
			$table->string('diskassure', 50)->nullable();
			$table->string('diskraidassure', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('old_yingpans');
	}

}
