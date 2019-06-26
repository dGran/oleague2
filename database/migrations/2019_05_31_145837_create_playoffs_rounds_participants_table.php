<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayoffsRoundsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("round_id")->unsigned();
            $table->integer("participant_id")->unsigned();

            $table->index('round_id', 'round_id_index');
            $table->index('participant_id', 'participant_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_rounds_participants');
    }
}
