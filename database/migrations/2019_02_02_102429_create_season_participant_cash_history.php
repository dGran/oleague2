<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonParticipantCashHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_participant_cash_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant_id')->unsigned()->index();
            $table->string('description');
            $table->decimal('amount');
            $table->string('movement');
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
        Schema::dropIfExists('season_participant_cash_history');
    }
}
