<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('receipt_no');
            $table->integer('status')->default(0);
            $table->double('total_price');
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('membership_id');
            $table->string('token')->default(Str::random(15));
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->foreign('membership_id')->references('id')->on('memberships');
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
        Schema::dropIfExists('orders');
    }
}
