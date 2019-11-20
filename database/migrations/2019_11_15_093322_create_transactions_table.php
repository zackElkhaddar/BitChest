<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('wallet_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('rate');
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table){
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('transactions', function (Blueprint $table){
            $table->dropForeign(['wallet_id']);
        });
        Schema::dropIfExists('transactions');
    }
}
