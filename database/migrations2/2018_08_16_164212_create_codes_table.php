<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('warehouse_out_management_id')->index()->comment('出库id');
            $table->unsignedInteger('product_good_id')->index()->comment('产品id');
            $table->unsignedInteger('product_good_num')->comment('产品数量');
            $table->string('product_good_number',10)->comment('产品编号');
            $table->json('code')->nullable()->comment('条码');
            $table->foreign('warehouse_out_management_id')->references('id')->on('warehouse_out_managements')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('codes');
    }
}
