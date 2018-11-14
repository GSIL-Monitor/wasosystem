<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('会员id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->char('number',2)->comment('序号');
            $table->string('name')->comment('单位名称');
            $table->string('unit')->nullable()->comment('单位简称');
            $table->string('unit_code')->nullable()->comment('单位简码');
            $table->string('address')->nullable()->comment('单位地址');
            $table->string('unit_phone')->nullable()->comment('单位电话');
            $table->string('fax')->nullable()->comment('传真号码');
            $table->string('zip')->nullable()->comment('邮编号码');
            $table->string('url')->nullable()->comment('官方网址');
            $table->string('tax_mode')->nullable()->default('no_invoice')->comment('含税模式');
            $table->string('tax_number')->nullable()->comment('税号');
            $table->string('account')->nullable()->comment('税号');
            $table->string('opening_bank')->nullable()->comment('开户行');
            $table->string('bank_address')->nullable()->comment('开户行地址');
            $table->string('bank_phone')->nullable()->comment('开户行电话');
            $table->string('finance')->nullable()->comment('财务人员');
            $table->string('finance_phone')->nullable()->comment('财务电话');
            $table->string('logistics')->nullable()->comment('物流');
            $table->boolean('default')->default(false)->comment('默认');
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
        Schema::dropIfExists('user_companies');
    }
}
