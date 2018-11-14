<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandManagementFiltratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_management_filtrates', function (Blueprint $table) {
            $table->unsignedInteger('demand_management_id')->index();
            $table->foreign('demand_management_id')->references('id')->on('demand_managements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('demand_filtrates_id')->index();
            $table->foreign('demand_filtrates_id')->references('id')->on('demand_filtrates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demand_management_filtrates');
    }
}
