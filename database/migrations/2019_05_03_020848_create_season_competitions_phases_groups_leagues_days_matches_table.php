<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonCompetitionsPhasesGroupsLeaguesDaysMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_competitions_phases_groups_leagues_days_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("day_id")->unsigned();
            $table->integer("local_id")->unsigned();
            $table->integer("local_user_id")->unsigned();
            $table->integer("local_score")->nullable();
            $table->integer("visitor_id")->unsigned();
            $table->integer("visitor_user_id")->unsigned();
            $table->integer("visitor_score")->nullable();
            $table->integer("santioned_id")->unsigned()->nullable();
            $table->dateTime('date_limit')->nullable();
            $table->boolean('active')->default(false);

            $table->index('day_id', 'day_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_competitions_phases_groups_leagues_days_matches');
    }
}
