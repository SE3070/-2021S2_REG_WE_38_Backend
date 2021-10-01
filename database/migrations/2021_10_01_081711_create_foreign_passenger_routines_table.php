<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignPassengerRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_passenger_routines', function (Blueprint $table) {
            $table->id();
            $table->string('route');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->unsignedBigInteger('psngr_id');
            $table->foreign('psngr_id')->references('id')->on('foreign_passengers');
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
        Schema::dropIfExists('foreign_passenger_routines');
    }
}
