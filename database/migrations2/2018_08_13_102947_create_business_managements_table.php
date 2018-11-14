<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['about','honor','service_directory','job','copyright','banner','friend'])->index()->comment('分类');
            $table->unsignedInteger('sort')->default(50)->comment('排序');
            $table->boolean('top')->default(false)->comment('置顶');
            $table->json('pic')->nullable()->comment('图片');
            $table->json('field')->nullable()->comment('需要的字段');
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
        Schema::dropIfExists('business_managements');
    }
}
