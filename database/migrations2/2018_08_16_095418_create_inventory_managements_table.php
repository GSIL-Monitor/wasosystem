<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->index()->comment('配件id');
            $table->unsignedInteger('product_good_id')->index()->comment('产品id');
            $table->unsignedInteger('new')->default(0)->nullable()->comment('新品数量');
            $table->unsignedInteger('good')->default(0)->nullable()->comment('良品数量');
            $table->unsignedInteger('bad')->default(0)->nullable()->comment('坏品数量');
            $table->unsignedInteger('return_factory')->default(0)->nullable()->comment('返厂数量');
            $table->unsignedInteger('proxies')->default(0)->nullable()->comment('代管数量');
            $table->unsignedInteger('test')->default(0)->nullable()->comment('测试品数量');
            $table->unsignedInteger('warning')->default(0)->nullable()->comment('报警线数量');
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
        Schema::dropIfExists('inventory_managements');
    }
}
