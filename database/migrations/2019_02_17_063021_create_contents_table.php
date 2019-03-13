<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('user_id')->index()->unsigned();
            $table->string('title')->index();
            $table->string('background_path')->nullable();
            $table->string('content_type'); // private, public
            $table->string('type')->nullable(); //movie, word doc, pdf
            $table->string('content_path')->nullable();
            $table->string('description');
            $table->text('detail')->nullable();
            $table->string('status')->default(config('studentbox.content-status.available'));
            $table->string('cost')->nullable();
            $table->string('number_of_download')->nullable();
            $table->string('number_of_sales')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
