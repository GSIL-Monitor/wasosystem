<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCompleteMachineProductGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('complete_machine_product_goods', function(Blueprint $table)
		{
			$table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('complete_machine_product_goods', function(Blueprint $table)
		{
			$table->dropForeign('complete_machine_product_goods_complete_machine_id_foreign');
			$table->dropForeign('complete_machine_product_goods_product_good_id_foreign');
		});
	}

}
