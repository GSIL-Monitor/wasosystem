<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration 
{
	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('account')->unsigned()->index();
            $table->string('name')->comment('姓名');
            $table->string('password');
            $table->boolean('isAdmin');
            $table->string('remember_token')->nullable()->comment('Token');
            $table->string('qq')->nullable()->comment('qq号码');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('phone')->nullable()->comment('电话号码');
            $table->string('entryed_at')->nullable()->comment('入职时间');
            $table->string('social_securityed_at')->nullable()->comment('社保购买时间');
            $table->string('pacted_at')->nullable()->comment('合同到期时间');
            $table->integer('rule_id')->nullable()->unsigned()->index()->comment('权限Id');
            $table->integer('login_count')->unsigned()->default(0)->comment('登陆次数');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('admins');
	}
}
