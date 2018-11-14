<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['company_dynamic','industry_trends','technical_expertise'])->default('company_dynamic')->index()->coment('分类');
            $table->string('name')->index()->coment('标题');
            $table->unsignedBigInteger('read_count')->default(0)->nullable()->comment('阅读量');
            $table->string('description',400)->coment('描述');
            $table->text('content')->comment('内容');
            $table->json('pic')->coment('图片');
            $table->json('marketing')->coment('tags');
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
        Schema::dropIfExists('information_managements');
    }
}
