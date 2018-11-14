<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandManagementOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_management_orders', function (Blueprint $table) {
            $table->unsignedInteger('demand_management_id')->index();
            $table->foreign('demand_management_id')->references('id')->on('demand_managements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('order_id')->index();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demand_management_orders');
    }
}
