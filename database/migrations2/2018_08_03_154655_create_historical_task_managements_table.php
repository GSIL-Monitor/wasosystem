<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricalTaskManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historical_task_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('divisional_id')->index()->comment('部门管理id');
            $table->unsignedInteger('goal')->defult(0)->nullable()->comment('目标任务');
            $table->unsignedInteger('guaranteed_task')->defult(0)->nullable()->comment('保底任务');
            $table->unsignedInteger('returned_money')->defult(0)->nullable()->comment('回款');
            $table->unsignedInteger('monthly_sales')->defult(0)->nullable()->comment('月销售');
            $table->unsignedInteger('outstanding')->defult(0)->nullable()->comment('发出未结');
            $table->unsignedInteger('year')->defult(0)->comment('年份');
            $table->unsignedInteger('mouth')->defult(0)->comment('月份');
            $table->string('punish_award')->defult(0)->nullable()->comment('奖惩（元）');
            $table->foreign('divisional_id')->references('id')->on('divisional_managements')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historical_task_managements');
    }
}
