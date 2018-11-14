<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('会员id');
            $table->unsignedInteger('visitor_details_id')->default(0)->index()->comment('客情id');
            $table->string('demand_number')->index()->comment('需求号');
            $table->json('collocate')->nullable()->comment('配置');
            $table->string('explain')->nullable()->comment('说明');
            $table->string('budget')->nullable()->comment('预算');
            $table->string('demand_status')->index()->comment('需求状态');
            $table->string('customer_status')->default('initial_contact')->comment('客户状态');
            $table->string('the_next_step_program')->nullable()->comment('下一步计划');
            $table->unsignedInteger('admin')->comment('所属管理员');
            $table->text('record')->nullable()->comment('交流记录');
            $table->string('assistant')->nullable()->comment('协助人员');
            $table->boolean('send')->default(false)->comment('是否通知');
            $table->boolean('analog_data')->default(false)->comment('模拟数据');
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
        Schema::dropIfExists('demand_managements');
    }
}
