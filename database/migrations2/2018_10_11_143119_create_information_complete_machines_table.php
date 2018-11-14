<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationCompleteMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_complete_machines', function (Blueprint $table) {
            $table->integer('information_management_id')->unsigned()->index();
            $table->integer('complete_machine_id')->unsigned()->index();
            $table->foreign('information_management_id')->references('id')->on('information_managements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information_complete_machines');
    }
}
