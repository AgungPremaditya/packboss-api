<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_package');
            $table->foreign('id_package')->references('id')->on('packages');
            $table->string('receipt_number')->unique();
            $table->float('price_per_kg', 8, 2);
            $table->float('total_price', 8, 2);
            $table->enum('status', [
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
        Schema::dropIfExists('transactions');
    }
}
