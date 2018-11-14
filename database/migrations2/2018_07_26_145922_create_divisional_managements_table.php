<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionalManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisional_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->enum('identifying',['company','department','group','member'])->comment('标识');
            $table->unsignedInteger('admin_id')->default(0)->nullable()->comment('成员id');
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
        Schema::dropIfExists('divisional_managements');
    }
}
