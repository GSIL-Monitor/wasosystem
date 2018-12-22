<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInformationManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('information_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array('company_dynamic','industry_trends','technical_expertise'))->default('company_dynamic')->index();
			$table->string('name')->index();
			$table->string('description', 400);
			$table->text('content', 65535)->comment('内容');
			$table->text('pic');
			$table->text('marketing');
			$table->timestamps();
			$table->integer('read_count')->nullable()->default(0)->comment('阅读量');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('information_managements');
	}

}
