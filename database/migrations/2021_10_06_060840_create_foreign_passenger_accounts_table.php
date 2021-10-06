<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignPassengerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_passenger_accounts', function (Blueprint $table) {
            $table->id();
            $table->float('balance');
            $table->float('tot_amount');
            $table->unsignedBigInteger('psngr_id');
            $table->timestamps();
            $table->foreign('psngr_id')->references('id')->on('foreign_passengers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_passenger_accounts');
    }
}
