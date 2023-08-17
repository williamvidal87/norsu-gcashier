<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_no');
            $table->string('payor_name');
            // $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('mode_of_payment_id');
            $table->unsignedBigInteger('cashier_id');
            $table->string('remark')->nullable();
            $table->date('date')->nullable();
            
            // $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('mode_of_payment_id')->references('id')->on('mode_of_payments');
            $table->foreign('cashier_id')->references('id')->on('users');
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
        Schema::dropIfExists('transactions');
    }
}
