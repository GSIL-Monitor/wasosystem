<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_materials', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->index();
            $table->integer('product_good_id')->unsigned()->index();
            $table->integer('product_good_num')->unsigned()->comment('数量');
            $table->integer('product_good_price')->unsigned()->nullable()->comment('价格');
            $table->string('product_good_raid')->nullable()->comment('raid');
            $table->string('product_number','2')->default('A')->index()->comment('排序');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_good_id')->references('id')->on('product_goods')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_materials');
    }
}
