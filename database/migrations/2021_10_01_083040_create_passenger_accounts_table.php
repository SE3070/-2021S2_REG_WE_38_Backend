<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passenger_accounts', function (Blueprint $table) {
            $table->id();
            $table->float('balance', 8, 2);
            $table->string('time_period');
            $table->unsignedBigInteger('psngr_id');
            $table->timestamps();
            $table->foreign('psngr_id')->references('id')->on('passengers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passenger_accounts');
    }
}
