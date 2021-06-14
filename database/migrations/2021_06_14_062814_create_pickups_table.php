<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_transaction');
            $table->foreign('id_transaction')->references('id')->on('transactions');
            $table->uuid('id_transport');
            $table->foreign('id_transport')->references('id')->on('transports');
            $table->timestamp('pickedup_at');
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
        Schema::dropIfExists('pickups');
    }
}
