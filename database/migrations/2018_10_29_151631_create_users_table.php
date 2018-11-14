<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('oid')->default(0)->comment('旧网站用户id');
			$table->string('username')->index()->comment('用户名');
			$table->string('password')->comment('密码');
			$table->string('clear_text')->nullable()->comment('明文密码');
			$table->string('nickname')->nullable()->comment('姓名');
			$table->enum('sex', array('Mr','lady','privary'))->default('privary')->comment('性别 先生/女士/保密');
			$table->string('birthday', 30)->nullable()->comment('生日');
			$table->string('phone')->index()->comment('手机号码');
			$table->string('email')->index()->comment('邮箱');
			$table->string('telephone')->nullable()->comment('座机');
			$table->string('wechat')->nullable()->comment('微信');
			$table->string('qq')->nullable()->comment('QQ');
			$table->string('unit')->nullable()->comment('单位简称');
			$table->string('industry')->nullable()->comment('行业');
			$table->string('address')->nullable()->comment('地址');
			$table->string('grade', 30)->default('unverified')->index()->comment('级别');
			$table->integer('administrator')->comment('管理员');
			$table->integer('payment_days')->unsigned()->default(0)->comment('账期');
			$table->integer('tax_rate')->default(1)->comment('税率');
			$table->enum('message_type', array('all_receiving','no_receiving','email_receiving','phone_receiving'))->default('all_receiving')->comment('信息接收方式');
			$table->boolean('parts_buy')->default(0)->comment('是否开启配件选购');
			$table->string('register_ip', 45)->nullable()->comment('注册IP');
			$table->string('last_login_ip', 45)->nullable()->comment('最后登录IP');
			$table->integer('login_count')->default(0)->comment('登陆次数');
			$table->dateTime('last_login_time')->nullable()->comment('最后一次登录时间');
			$table->boolean('deal')->default(0)->comment('是否成交');
			$table->text('avatar')->nullable()->comment('头像');
			$table->text('parameters')->nullable()->comment('额外参数');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->integer('notification_count')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
