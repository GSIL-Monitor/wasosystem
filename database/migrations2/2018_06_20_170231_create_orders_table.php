<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('会员id');
            $table->string('serial_number')->index()->comment('订单序列号');
            $table->string('machine_model')->nullable()->comment('整机型号');
            $table->string('code')->default(0)->comment('配置代码');
            $table->integer('unit_price')->default(0)->comment('单价');
            $table->integer('total_prices')->default(0)->comment('总价');
            $table->integer('price_spread')->nullable()->default(0)->comment('差价');
            $table->integer('num')->default(1)->comment('数量');
            $table->string('order_type')->default('parts')->comment('订单类型');
            $table->string('order_status')->default('intention_to_order')->index()->comment('订单状态');
            $table->string('message_status')->default('intention_to_order')->comment('信息发送状态');
            $table->string('payment_status')->default('')->comment('款项状态');
            $table->integer('service_status')->default(0)->comment('服务状态');
            $table->string('invoice_type')->default('no_invoice')->comment('开票类型');
            $table->integer('invoice_info')->nullable()->default(0)->comment('开票信息');
            $table->integer('logistics_id')->nullable()->default(0)->comment('物流地址');
            $table->string('logistics_info')->nullable()->comment('物流信息');
            $table->integer('parcel_count')->default(1)->comment('包裹树');
            $table->text('user_remark')->nullable()->comment('客户备注');
            $table->text('company_remark')->nullable()->comment('公司备注');
            $table->boolean('urgent')->default(false)->comment('是否加急');
            $table->boolean('flow_pic')->default(false)->comment('是否流程图');
//            $table->boolean('in_common_use')->default(false)->comment('是否常用配置');
            $table->json('pic')->nullable()->comment('装机流程图');
            $table->integer('market')->index()->comment('销售人员');
            $table->json('participation_admin')->nullable()->comment('订单参与人员');
            $table->integer('admin')->nullable()->comment('订单操作人员');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
