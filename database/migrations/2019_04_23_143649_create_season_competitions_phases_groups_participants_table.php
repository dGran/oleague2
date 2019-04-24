<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonCompetitionsPhasesGroupsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_competitions_phases_groups_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("group_id")->unsigned();
            $table->integer("participant_id")->unsigned();

            $table->index('group_id', 'group_id_index');
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
        Schema::dropIfExists('season_competitions_phases_groups_participants');
    }
}
