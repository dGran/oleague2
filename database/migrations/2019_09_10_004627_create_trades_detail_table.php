<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("trade_id")->unsigned();
            $table->integer("player1_id")->unsigned()->nullable();
            $table->integer("player2_id")->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades_detail');
    }
}
