<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserUpdateResultAndDateUpdateResultToSeasonCompetitionsMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('season_competitions_matches', function (Blueprint $table) {
            $table->integer("user_update_result")->unsigned()->nullable();
            $table->datetime("date_update_result")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('season_competitions_matches', function (Blueprint $table) {
            $table->dropColumn('user_update_result');
            $table->dropColumn('date_update_result');
        });
    }
}
