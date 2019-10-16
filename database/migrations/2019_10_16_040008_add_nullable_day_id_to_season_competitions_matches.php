<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableDayIdToSeasonCompetitionsMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('season_competitions_matches', function (Blueprint $table) {
            $table->integer('day_id')->nullable()->change();
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
            $table->integer('day_id')->nullable(false)->change();
        });
    }
}
