<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCompleteMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_complete_machines', function (Blueprint $table) {
            $table->unsignedInteger('complete_machine_id')->index();
            $table->unsignedInteger('video_id')->index();
            $table->foreign('complete_machine_id')->references('id')->on('complete_machines')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('video_id')->references('id')->on('videos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_complete_machines');
    }
}
