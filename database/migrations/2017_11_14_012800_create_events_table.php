<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venue_id')->unsigned();
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('intro')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('startdatetime')->nullable();
            $table->dateTime('enddatetime')->nullable();
            $table->string('facebook')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->dateTime('presalestart')->nullable();
            $table->dateTime('presaleend')->nullable();
            $table->integer('presaleprice')->unsigned()->nullable();
            $table->string('presalenote')->nullable();
            $table->dateTime('salestart')->nullable();
            $table->dateTime('saleend')->nullable();
            $table->integer('saleprice')->unsigned()->nullable();
            $table->string('salenote')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
}
