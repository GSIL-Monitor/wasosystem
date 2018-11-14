<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDemandManagementFiltratesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('demand_management_filtrates', function(Blueprint $table)
		{
			$table->integer('demand_management_id')->unsigned()->index();
			$table->integer('demand_filtrates_id')->unsigned()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('demand_management_filtrates');
	}

}
