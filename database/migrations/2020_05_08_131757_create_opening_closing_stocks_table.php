<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateOpeningClosingStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_closing_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->integer('opening_stock');
            $table->integer('supplies')->default(0);
            $table->integer('total_opening_stock')->default(0);
            $table->integer('promo')->default(0);
            $table->integer('total_closing_stock')->default(0);
            $table->integer('sales')->default(0);
            $table->string('token')->default(Str::random(15));
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('opening_closing_stocks');
    }
}
