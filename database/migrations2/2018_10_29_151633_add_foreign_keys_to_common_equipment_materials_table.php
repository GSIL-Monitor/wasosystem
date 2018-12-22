<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCommonEquipmentMaterialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('common_equipment_materials', function(Blueprint $table)
		{
			$table->foreign('common_equipment_id')->references('id')->on('common_equipments')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('common_equipment_materials', function(Blueprint $table)
		{
			$table->dropForeign('common_equipment_materials_common_equipment_id_foreign');
			$table->dropForeign('common_equipment_materials_product_good_id_foreign');
		});
	}

}
