<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSelfBuildTerracesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('self_build_terraces', function(Blueprint $table)
		{
			$table->integer('product_good_id')->unsigned()->index();
			$table->integer('self_build_terrace_id')->unsigned()->index();
			$table->integer('product_good_num')->unsigned()->comment('数量');
			$table->string('product_number', 2)->default('A')->index()->comment('排序');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('self_build_terraces');
	}

}
