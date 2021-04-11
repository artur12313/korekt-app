<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_orders', function (Blueprint $table) {
            $table->dropForeign('products_orders_product_id_foreign');
            $table->dropForeign('products_orders_order_id_foreign');
            $table->foreign('product_id')->references('id')->on('produkty')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('zamowienia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}