<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonCompetitionsPhasesGroupsLeaguesDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_competitions_phases_groups_leagues_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("league_id")->unsigned();
            $table->integer('order');
            $table->dateTime('date_limit')->nullable();
            $table->boolean('active')->default(false);

            $table->index('league_id', 'league_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_competitions_phases_groups_leagues_days');
    }
}
