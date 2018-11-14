<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandFiltratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_filtrates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->enum('category',['issue','answer'])->default('issue')->index()->comment('参数分类');
            $table->nestedSet();
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
        Schema::dropIfExists('demand_filtrates');
    }
}
