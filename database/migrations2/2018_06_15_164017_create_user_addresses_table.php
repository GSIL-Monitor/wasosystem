<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('会员id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->char('number',2)->comment('序号');
            $table->string('name')->comment('收货人');
            $table->string('phone')->nullable()->comment('收货人电话');
            $table->string('address')->nullable()->comment('收货地址');
            $table->string('alternative_phone')->nullable()->comment('备用电话');
            $table->string('logistics')->nullable()->comment('指定物流');
            $table->string('zip')->nullable()->comment('邮编号码');
            $table->boolean('default')->default(false)->comment('默认');
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
        Schema::dropIfExists('user_addresses');
    }
}
