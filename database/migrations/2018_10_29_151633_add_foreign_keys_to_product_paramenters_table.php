<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductParamentersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_paramenters', function(Blueprint $table)
		{
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_paramenters', function(Blueprint $table)
		{
			$table->dropForeign('product_paramenters_product_id_foreign');
		});
	}

}
