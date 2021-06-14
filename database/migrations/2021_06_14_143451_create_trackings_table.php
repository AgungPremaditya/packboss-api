<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_transaction');
            $table->foreign('id_transaction')->references('id')->on('transactions');
            $table->uuid('id_transport');
            $table->foreign('id_transport')->references('id')->on('transports');
            $table->uuid('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->enum('tracking_status', [
                'waiting-for-pickup',
                'on-pickup', 
                'on-office-storage', 
                'on-sorting', 
                'on-delivery-courier', 
                'delivered',
                'canceled'
            ]);
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
        Schema::dropIfExists('trackings');
    }
}
