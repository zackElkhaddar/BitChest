<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('credit');
            $table->timestamps();
        });

        Schema::table('wallets', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('wallets', function (Blueprint $table){
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
        Schema::table('wallets', function (Blueprint $table){
            $table->dropForeign(['currency_id']);
        });
        Schema::dropIfExists('wallets');
    }
}
