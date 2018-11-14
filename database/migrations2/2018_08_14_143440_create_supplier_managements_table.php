<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('简称');
            $table->string('code')->index()->comment('简码');
            $table->unsignedInteger('sales_return_count')->default(0)->nullable()->comment('退货数量');
            $table->unsignedInteger('factory_return_count')->default(0)->nullable()->comment('返厂数量');
            $table->string('linkman')->nullable()->comment('联系人');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->string('address')->nullable()->comment('联系地址');
            $table->string('admin')->comment('采购人员');
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
        Schema::dropIfExists('supplier_managements');
    }
}
