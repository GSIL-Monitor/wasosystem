<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOldOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('old_orders', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('userid', 64)->nullable();
			$table->string('s_id', 64)->nullable();
			$table->string('cpuid', 64)->nullable();
			$table->string('cpu_num', 8)->nullable();
			$table->string('biosid', 64)->nullable();
			$table->string('memoryid', 64)->nullable();
			$table->string('memory_num', 8)->nullable();
			$table->string('agpid', 200)->nullable();
			$table->string('net_work', 200)->nullable();
			$table->string('box', 64)->nullable();
			$table->string('power', 64)->nullable();
			$table->string('rd', 64)->nullable();
			$table->string('dvd', 64)->nullable();
			$table->string('other1', 64)->nullable();
			$table->string('other2', 64)->nullable();
			$table->string('other3', 64)->nullable();
			$table->string('other4', 64)->nullable();
			$table->string('other5', 64)->nullable();
			$table->string('other1_num', 8)->nullable();
			$table->string('other2_num', 8)->nullable();
			$table->string('other3_num', 8)->nullable();
			$table->string('other4_num', 8)->nullable();
			$table->string('other5_num', 8)->nullable();
			$table->string('proid', 50)->nullable();
			$table->string('prodate', 50)->nullable();
			$table->integer('prostatus')->nullable();
			$table->string('prostatuss', 50)->nullable();
			$table->string('prowlinfoo', 50)->nullable();
			$table->string('prowlinfo')->nullable();
			$table->string('proremark')->nullable();
			$table->string('pirp', 50)->nullable();
			$table->integer('all_price')->nullable();
			$table->string('special_card', 50)->nullable();
			$table->string('beizhu')->nullable();
			$table->string('cpuprice', 50)->nullable();
			$table->string('biosprice', 50)->nullable();
			$table->string('memoryprice', 50)->nullable();
			$table->string('agpprice', 50)->nullable();
			$table->string('net_workprice', 50)->nullable();
			$table->string('boxprice', 50)->nullable();
			$table->string('powerprice', 50)->nullable();
			$table->string('rdprice', 50)->nullable();
			$table->string('dvdprice', 50)->nullable();
			$table->string('other1price', 50)->nullable();
			$table->string('other2price', 50)->nullable();
			$table->string('other3price', 50)->nullable();
			$table->string('other4price', 50)->nullable();
			$table->string('other5price', 50)->nullable();
			$table->string('special_cardprice', 50)->nullable();
			$table->string('mode', 50)->nullable();
			$table->string('hotprice', 50)->nullable();
			$table->text('hotinfo')->nullable();
			$table->text('repark')->nullable();
			$table->string('pri_id', 50)->nullable();
			$table->string('totalnum', 50)->nullable();
			$table->string('wlnum', 50)->nullable();
			$table->string('totalprice', 50)->nullable();
			$table->string('Nread', 50)->nullable();
			$table->integer('zbmode')->nullable();
			$table->string('cpuassure', 50)->nullable();
			$table->string('biosassure', 50)->nullable();
			$table->string('memoryassure', 50)->nullable();
			$table->string('agpassure', 50)->nullable();
			$table->string('net_workassure', 50)->nullable();
			$table->string('boxassure', 50)->nullable();
			$table->string('powerassure', 50)->nullable();
			$table->string('rdassure', 50)->nullable();
			$table->string('dvdassure', 50)->nullable();
			$table->string('other1assure', 50)->nullable();
			$table->string('other2assure', 50)->nullable();
			$table->string('other3assure', 50)->nullable();
			$table->string('other4assure', 50)->nullable();
			$table->string('other5assure', 50)->nullable();
			$table->string('special_cardassure', 50)->nullable();
			$table->string('S_name', 150)->nullable();
			$table->integer('points')->nullable();
			$table->string('sound', 50)->nullable();
			$table->text('remarks')->nullable();
			$table->text('content')->nullable();
			$table->string('retail_price', 50)->nullable();
			$table->text('Tpic')->nullable();
			$table->text('Spic')->nullable();
			$table->boolean('view')->nullable();
			$table->string('zt', 4)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('old_orders');
	}

}
