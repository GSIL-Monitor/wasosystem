<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_managements_id')->index()->comment('供应商id');
            $table->unsignedInteger('product_good_id')->index()->comment('采购产品id');
            $table->unsignedInteger('product_id')->index()->comment('采购产品id');
            $table->enum('procurement_type',['procurement','test'])->default('procurement')->comment('采购类型');
            $table->enum('product_colour',['new','good','bad'])->default('new')->comment('产品成色');
            $table->enum('procurement_status',['procurement','finish','unfinished'])->default('procurement')->comment('采购入库状态');
            $table->string('serial_number')->comment('序列号');
            $table->unsignedInteger('procurement_number')->comment('采购数量');
            $table->unsignedInteger('finish_procurement_number')->default(0)->nullable()->comment('已采购数量');
            $table->unsignedInteger('quality_time')->nullable()->comment('质保时间');
            $table->string('postscript',400)->nullable()->comment('备注信息');
            $table->string('logistics_company')->nullable()->comment('物流公司');
            $table->string('logistics_number')->nullable()->comment('物流单号');
            $table->unsignedInteger('admin')->comment('操作人员');
            $table->unsignedInteger('purchase')->comment('采购人员');
            $table->json('code')->nullable()->comment('条码');
            $table->json('two_code')->nullable()->comment('二级条码');
            $table->foreign('supplier_managements_id')->references('id')->on('supplier_managements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('procurement_plans');
    }
}
