<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('season_id')->unsigned()->index();
            $table->integer('team_id')->unsigned()->nullable()->index();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->integer('budget')->index()->default(0);
            $table->integer('paid_clauses')->default(0);
            $table->integer('clauses_received')->default(0);
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
        Schema::dropIfExists('season_participants');
    }
}
