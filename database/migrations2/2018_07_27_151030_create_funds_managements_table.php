<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundsManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('用户名');
            $table->enum('type',['deposit','pay','down_payment'])->default('down_payment')->comment('金额类型');
            $table->unsignedInteger('price')->default(0)->nullable()->comment('金额');
            $table->string('comment',400)->nullable()->comment('备注');
            $table->unsignedInteger('operate')->comment('操作人员');
            $table->unsignedInteger('market')->index()->comment('销售人员');
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
        Schema::dropIfExists('funds_managements');
    }
}
