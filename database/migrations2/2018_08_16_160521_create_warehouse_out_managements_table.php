<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseOutManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_out_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('收货单位');
            $table->unsignedInteger('order_id')->index()->default(0)->nullable()->comment('订单id');
            $table->enum('out_type',['sell','loan_out'])->default('sell')->comment('出库类型');
            $table->boolean('associated_disposal')->default(false)->comment('关联处理');
            $table->enum('out_status',['finish','unfinished'])->default('unfinished')->comment('出库状态');
            $table->string('serial_number')->index()->comment('出库序号/订单序号');
            $table->unsignedInteger('out_number')->comment('出库数量');
            $table->unsignedInteger('finish_out_number')->default(0)->nullable()->comment('已出库数量');
            $table->unsignedInteger('admin')->comment('操作人员');
            $table->string('postscript',400)->nullable()->comment('备注信息');
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
        Schema::dropIfExists('warehouse_out_managements');
    }
}
