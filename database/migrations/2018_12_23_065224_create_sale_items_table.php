<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sale_order_ref');
            $table->string('product_sku');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('sale_order_ref')->references('ref')
                    ->on('sale_orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_sku')->references('sku')
                    ->on('products')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
