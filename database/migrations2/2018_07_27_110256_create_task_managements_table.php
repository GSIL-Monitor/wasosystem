<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('divisional_id')->index()->comment('部门管理id');
            $table->enum('task_mode',['single','multiterm'])->default('single')->comment('任务模式');

            $table->unsignedInteger('goal')->defult(0)->comment('目标任务（万）');
            $table->unsignedInteger('guaranteed_task')->defult(0)->comment('保底任务（万）');
            $table->unsignedInteger('award_coefficient')->defult(0)->comment('奖励系数（%）');

            $table->unsignedInteger('goal_two')->defult(0)->nullable()->comment('目标任务二（万）');
            $table->unsignedInteger('award_coefficient_two')->defult(0)->nullable()->comment('奖励系数二（%）');

            $table->unsignedInteger('goal_three')->defult(0)->nullable()->comment('目标任务三（万）');
            $table->unsignedInteger('award_coefficient_three')->defult(0)->nullable()->comment('奖励系数三（%）');

            $table->unsignedInteger('punish_index')->defult(0)->nullable()->comment('处罚指标（元）');
            $table->unsignedInteger('award_index')->defult(0)->nullable()->comment('奖励指标（元）');
            $table->unsignedInteger('units_index')->defult(0)->nullable()->comment('单位指标（万）');
            $table->foreign('divisional_id')->references('id')->on('divisional_managements')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('task_managements');
    }
}
