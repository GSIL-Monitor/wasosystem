<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTemporaryProductGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('temporary_product_goods', function(Blueprint $table)
		{
			$table->foreign('admin_id')->references('id')->on('admins')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('temporary_product_goods', function(Blueprint $table)
		{
			$table->dropForeign('temporary_product_goods_admin_id_foreign');
			$table->dropForeign('temporary_product_goods_product_good_id_foreign');
		});
	}

}
