<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('user_id')->index()->unsigned();
            $table->string('doc_link')->nullable();
            $table->bigInteger('content_id')->nullable()->index()->unsigned(); //content is private
            $table->string('status');
            $table->string('accepted_by')->nullable();
            $table->datetime('accepted_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->datetime('due_date')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('cancelled_at')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
