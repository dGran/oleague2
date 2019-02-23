<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('num_participants')->default(0);
            $table->boolean('participant_has_team')->default(1);
            $table->boolean('use_economy')->default(1);
            $table->integer('initial_budget')->default(0);
            $table->boolean('use_rosters')->default(1);
            $table->integer('min_players')->default(0);
            $table->integer('max_players')->default(0);
            $table->boolean('change_salaries_period')->default(0);
            $table->boolean('transfers_period')->default(0);
            $table->boolean('free_players_period')->default(0);
            $table->boolean('clausules_period')->default(0);
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
        Schema::dropIfExists('seasons');
    }
}