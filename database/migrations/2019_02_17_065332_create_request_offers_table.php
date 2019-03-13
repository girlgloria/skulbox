<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_offers', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('request_id')->index()->unsigned();
            $table->string('offer');
            $table->bigInteger('user_id')->index()->unsigned();
            $table->text('reason')->nullable();
            $table->string('status');
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('request_offers');
    }
}
