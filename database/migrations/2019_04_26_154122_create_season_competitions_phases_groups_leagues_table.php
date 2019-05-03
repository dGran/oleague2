<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonCompetitionsPhasesGroupsLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_competitions_phases_groups_leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("group_id")->unsigned();
            $table->boolean("allow_draws")->default(true);
            $table->float('win_points', 8, 2)->default(3);
            $table->float('draw_points', 8, 2)->default(1);
            $table->float('lose_points', 8, 2)->default(0);
            $table->float('play_amount', 8, 2)->nullable();
            $table->float('win_amount', 8, 2)->nullable();
            $table->float('draw_amount', 8, 2)->nullable();
            $table->float('lose_amount', 8, 2)->nullable();
            $table->boolean("stats_mvp")->default(false);
            $table->boolean("stats_goals")->default(false);
            $table->boolean("stats_assists")->default(false);
            $table->boolean("stats_yellow_cards")->default(false);
            $table->boolean("stats_red_cards")->default(false);

            $table->index('group_id', 'group_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_competitions_phases_groups_leagues');
    }
}
