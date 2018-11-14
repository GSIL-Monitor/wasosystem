<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_backs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('称呼');
            $table->string('title')->comment('标题');
            $table->string('email')->comment('邮箱');
            $table->string('phone')->nullable()->comment('电话');
            $table->string('content')->comment('内容');
            $table->boolean('show')->default(false)->comment('内容');
            $table->json('location')->nullable()->comment('位置信息');
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
        Schema::dropIfExists('feed_backs');
    }
}
