<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierRepairAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_repair_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_managements_id')->index()->commment('供应商id');
            $table->string('name')->comment('售后人员');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->string('email')->nullable()->comment('联系邮箱');
            $table->string('address')->nullable()->comment('联系地址');
            $table->string('admin')->comment('操作人员');
            $table->foreign('supplier_managements_id')->references('id')->on('supplier_managements')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('supplier_repair_addresses');
    }
}
