<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeChatApplicationManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_chat_application_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifying')->unique()->comment('应用标识');
            $table->unsignedInteger('agentId')->index()->comment('应用id');
            $table->string('name')->comment('应用名');
            $table->string('secret',400)->nullable()->comment('应用secret');
            $table->string('description',400)->nullable()->comment('应用描述');
            $table->json('group_chat_array')->nullable()->comment('群聊数组');
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
        Schema::dropIfExists('we_chat_application_managements');
    }
}
