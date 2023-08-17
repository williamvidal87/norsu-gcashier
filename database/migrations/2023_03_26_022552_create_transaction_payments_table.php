<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('payment_categories_id');
            $table->unsignedBigInteger('payment_detail_id');
            $table->string('qty');
            $table->string('price');
            $table->string('transaction_category');
            
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('payment_categories_id')->references('id')->on('payment_categories');
            $table->foreign('payment_detail_id')->references('id')->on('payment_details');
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
        Schema::dropIfExists('transaction_payments');
    }
}
