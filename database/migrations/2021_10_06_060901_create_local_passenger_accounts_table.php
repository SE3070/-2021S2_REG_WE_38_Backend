<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalPassengerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_passenger_accounts', function (Blueprint $table) {
            $table->id();
            $table->float('balance');
            $table->float('tot_amount');
            $table->unsignedBigInteger('psngr_id');
            $table->timestamps();
            $table->foreign('psngr_id')->references('id')->on('local_passengers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_passenger_accounts');
    }
}
