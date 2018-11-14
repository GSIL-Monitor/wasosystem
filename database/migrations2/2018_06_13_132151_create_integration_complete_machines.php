<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrationCompleteMachines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integration_complete_machines', function (Blueprint $table) {
            $table->integer('integration_id')->unsigned()->index();
            $table->integer('complete_machine_id')->unsigned()->index();
            $table->foreign('integration_id')->references('id')->on('integrations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('integration_complete_machines');
    }
}
