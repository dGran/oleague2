<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('players_db_id')->unsigned()->index();
            $table->string('game_id')->nullable()->index();
            $table->string('name')->index();
            $table->string('img')->nullable();
            $table->string('team_name')->nullable();
            $table->integer('team_id')->unsigned()->nullable()->index();
            $table->string('nation_name')->nullable();
            $table->string('league_name')->nullable();
            $table->string('position')->nullable()->index();
            $table->integer('height')->nullable()->index();
            $table->integer('age')->nullable()->index();
            $table->integer('overall_rating')->nullable()->index();
            $table->string('slug')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
