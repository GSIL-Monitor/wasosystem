<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->comment('会员id');
			$table->char('number', 2)->comment('序号');
			$table->string('name')->comment('收货人');
			$table->string('phone')->nullable()->comment('收货人电话');
			$table->string('address')->nullable()->comment('收货地址');
			$table->string('alternative_phone')->nullable()->comment('备用电话');
			$table->string('logistics')->nullable()->comment('指定物流');
			$table->string('zip')->nullable()->comment('邮编号码');
			$table->boolean('default')->default(0)->comment('默认');
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
		Schema::drop('user_addresses');
	}

}
