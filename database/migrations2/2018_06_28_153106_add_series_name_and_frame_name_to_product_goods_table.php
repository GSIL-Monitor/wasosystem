<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeriesNameAndFrameNameToProductGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_goods', function (Blueprint $table) {
            $table->string('series_name')->index()->comment('系列名');
            $table->string('framework_name')->index()->comment('架构名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_goods', function (Blueprint $table) {
          $table->dropColumn(['series_name','framework_name']);
        });
    }
}
