<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderAndPenaltiesToSeasonCompetitionsMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('season_competitions_matches', function (Blueprint $table) {
            $table->integer('order')->default(1);
            $table->boolean('penalties')->default(false);
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
            $table->dropColumn('order');
            $table->dropColumn('penalties');
        });
    }
}
