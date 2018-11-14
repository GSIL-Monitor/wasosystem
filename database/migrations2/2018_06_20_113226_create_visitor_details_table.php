<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->default(0)->comment('会员id');
            $table->string('source')->nullable()->comment('客户来源');
            $table->string('nickname')->nullable()->comment('客户名称');
            $table->string('industry')->nullable()->comment('行业');
            $table->string('address')->nullable()->comment('地址');
            $table->string('search')->nullable()->comment('搜索词');
            $table->string('key')->nullable()->comment('关键词');
            $table->string('phone')->nullable()->comment('手机号码');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('wechat')->nullable()->comment('微信');
            $table->string('qq')->nullable()->comment('QQ');
            $table->integer('admin')->nullable()->default(0)->comment('值班客服');
            $table->text('details')->nullable()->comment('客户备注');
            $table->enum('contact_count',['one','two'])->default('one')->comment('联系次数');
            $table->enum('valid',['yes','no'])->default('no')->index()->comment('是否有效');
//            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('visitor_details');
    }
}
