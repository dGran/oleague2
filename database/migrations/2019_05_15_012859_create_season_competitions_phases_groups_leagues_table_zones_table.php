<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonCompetitionsPhasesGroupsLeaguesTableZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_competitions_phases_groups_leagues_table_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("league_id")->unsigned();
            $table->integer("table_zone_id")->unsigned()->nullable();
            $table->integer("position");

            $table->index('league_id', 'league_id_index');
            $table->index('table_zone_id', 'table_zone_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_competitions_phases_groups_leagues_table_zones');
    }
}
