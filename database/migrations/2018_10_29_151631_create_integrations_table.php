<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntegrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('integrations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->default(0)->index()->comment('父级id');
			$table->integer('click')->unsigned()->comment('点击量');
			$table->string('name')->index()->comment('名称');
			$table->text('pic')->nullable()->comment('标题图片');
			$table->string('description', 300)->nullable()->comment('描述');
			$table->boolean('show')->default(1)->comment('是否显示');
			$table->text('details', 65535)->nullable()->comment('详情');
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
		Schema::drop('integrations');
	}

}
