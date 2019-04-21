<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonCompetitionsPhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_competitions_phases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("competition_id")->unsigned()->index();
            $table->string('name')->index();
            $table->enum('mode', ['league', 'playoffs']);
            $table->integer('num_participants')->nullable();
            $table->integer('order')->index();
            $table->boolean('active')->deafult(false);
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_competitions_phases');
    }
}
