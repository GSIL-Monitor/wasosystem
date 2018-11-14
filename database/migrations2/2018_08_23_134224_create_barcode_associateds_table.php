<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarcodeAssociatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_associateds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_managements_id')->index()->default(0)->nullable()->comment('供应商id');
            $table->unsignedInteger('user_id')->index()->default(0)->nullable()->comment('收货单位');
            $table->unsignedInteger('order_id')->index()->default(0)->nullable()->comment('订单id');
            $table->unsignedInteger('procurement_plans_id')->index()->default(0)->nullable()->comment('入库id');
            $table->unsignedInteger('warehouse_out_management_id')->index()->default(0)->nullable()->comment('出库id');
            $table->unsignedInteger('product_good_id')->index()->comment('产品id');
            $table->string('code')->index()->comment('条码');
            $table->string('two_code')->nullable()->index()->comment('二级条码');
            $table->string('current_state')->nullable()->comment('当前状态');
            $table->enum('product_colour',['new','good','bad'])->default('new')->comment('产品成色');
            $table->string('postscript',400)->nullable()->comment('备注信息');
            $table->string('description')->nullable()->comment('描述');
            $table->string('location')->nullable()->comment('归属地');
            $table->boolean('associated_disposal')->default(false)->comment('关联处理');
            $table->unsignedInteger('admin')->comment('操作人员');
            $table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('barcode_associateds');
    }
}
