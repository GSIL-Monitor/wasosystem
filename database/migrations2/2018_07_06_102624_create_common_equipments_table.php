<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('会员id');
            $table->unsignedInteger('order_id')->index()->comment('订单id');
            $table->string('name')->index()->comment('配置名');
            $table->string('machine_model')->nullable()->comment('整机型号');
            $table->string('code')->default(0)->comment('配置代码');
            $table->integer('unit_price')->default(0)->comment('单价');
            $table->integer('total_prices')->default(0)->comment('总价');
            $table->integer('old_prices')->default(0)->comment('更新前价格');
            $table->integer('num')->default(1)->comment('数量');
            $table->string('order_type')->default('parts')->comment('订单类型');
            $table->integer('service_status')->default(0)->comment('服务状态');
            $table->string('invoice_type')->default('no_invoice')->comment('开票类型');
            $table->text('user_remark')->nullable()->comment('客户备注');
            $table->text('company_remark')->nullable()->comment('公司备注');
            $table->integer('market')->index()->comment('销售人员');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('common_equipments');
    }
}
