<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompetitionIdColumnInSeasonCompetitionsMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('season_competitions_matches', function (Blueprint $table) {
            $table->integer('competition_id')->unsigned()->nullable();
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
            $table->dropColumn('competition_id');
        });
    }
}
