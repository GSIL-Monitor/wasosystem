<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompleteMachineProductGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_machine_product_goods', function (Blueprint $table) {
            $table->integer('complete_machine_id')->unsigned()->index();
            $table->integer('product_good_id')->unsigned()->index();
            $table->integer('product_good_num')->unsigned()->comment('数量');
            $table->string('product_number','2')->default('A')->index()->comment('排序');
            $table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('complete_machine_product_goods');
    }
}
