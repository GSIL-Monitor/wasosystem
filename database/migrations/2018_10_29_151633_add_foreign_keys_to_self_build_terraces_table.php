<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSelfBuildTerracesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('self_build_terraces', function(Blueprint $table)
		{
			$table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('self_build_terrace_id')->references('id')->on('product_goods')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('self_build_terraces', function(Blueprint $table)
		{
			$table->dropForeign('self_build_terraces_product_good_id_foreign');
			$table->dropForeign('self_build_terraces_self_build_terrace_id_foreign');
		});
	}

}
