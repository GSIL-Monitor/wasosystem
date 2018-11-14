<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->index()->comment('质保序号');
            $table->string('username')->nullable()->comment('客户信息');
            $table->string('order_serial_number')->nullable()->comment('申报订单号');
            $table->string('quality_assurance_model')->default('manual_service')->comment('质保模式');
            $table->string('quality_assurance_status')->default('quality_assurance_apply_for')->comment('质保状态');
            $table->string('service_event',2)->default('E')->comment('质保状态');
            $table->text('error_description')->nullable()->comment('故障描述');
            $table->text('solution')->nullable()->comment('解决办法');
            $table->json('product_goods')->nullable()->comment('质保产品');
            $table->json('door_and_service_staff')->nullable()->comment('上门人员和服务人员');
            $table->timestamp('door_of_time')->nullable()->comment('上门时间');
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
        Schema::dropIfExists('services');
    }
}
