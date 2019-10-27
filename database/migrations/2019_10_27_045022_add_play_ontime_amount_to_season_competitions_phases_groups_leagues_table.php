<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayOntimeAmountToSeasonCompetitionsPhasesGroupsLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('season_competitions_phases_groups_leagues', function (Blueprint $table) {
            $table->float('play_ontime_amount', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('season_competitions_phases_groups_leagues', function (Blueprint $table) {
            $table->dropColumn('play_ontime_amount');
        });
    }
}
