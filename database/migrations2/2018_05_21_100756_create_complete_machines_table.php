<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompleteMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_machines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('产品型号');
            $table->string('code',300)->comment('配置代码');
            $table->json('price')->comment('产品价格');
            $table->enum('float',['come-up','lower','smooth'])->nullable()->default('smooth')->comment('价格浮动');
            $table->enum('marketing',['none','new','hot','moods','sale'])->default('none')->comment('营销');
            $table->json('status')->nullable()->comment('产品状态');
            $table->integer('quality_time')->nullable()->index()->comment('质保时间');
            $table->integer('weight')->nullable()->comment('重量');
            $table->json('jiagou')->nullable()->comment('架构类型');
            $table->json('additional_arguments')->nullable()->comment('额外参数');
            $table->json('application')->nullable()->comment('应用类型');
            $table->integer('sales_volume')->nullable()->default(0)->comment('销量');
            $table->integer('parent_id')->nullable()->default(0)->comment('所属产品');
            $table->text('details')->nullable()->comment('产品详情');
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
        Schema::dropIfExists('complete_machines');
    }
}
