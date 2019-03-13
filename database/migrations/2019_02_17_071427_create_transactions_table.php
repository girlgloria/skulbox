<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id')->index();
            $table->bigInteger('user_id')->index()->unsigned();
            $table->string('customer_name')->nullable();
            $table->string('merchant_request_id')->nullable();
            $table->string('checkout_request_id')->nullable();
            $table->string('result_code')->nullable();
            $table->string('reference')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('description')->nullable();
            $table->text('result_description')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('transaction_date')->nullable();
            $table->bigInteger('content_id')->index()->unsigned();
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
