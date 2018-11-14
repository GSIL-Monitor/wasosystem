<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->index()->default(0)->comment('父级id');
            $table->unsignedInteger('click')->comment('点击量');
            $table->string('name')->index()->comment('名称');
            $table->json('pic')->nullable()->comment('标题图片');
            $table->string('description',300)->nullable()->comment('描述');
            $table->boolean('show')->default(1)->comment('是否显示');
            $table->text('details')->nullable()->comment('详情');
            $table->foreign('parent_id')->references('id')->on('integration_categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('integrations');
    }
}
