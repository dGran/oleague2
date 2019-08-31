<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("season_id")->unsigned()->index();
            $table->integer("player_id")->unsigned()->index();
            $table->integer("participant_id")->unsigned()->nullable()->index()->default(0);
            $table->decimal("salary")->default(0.5);
            $table->integer("price")->default(5);
            $table->boolean('allow_clause_pay')->default(1);
            $table->boolean('untransferable')->default(0)->index();
            $table->boolean('transferable')->default(0)->index();
            $table->decimal('sale_price')->nullable()->default(0);
            $table->boolean('sale_auto_accept')->default(0);
            $table->boolean('player_on_loan')->default(0)->index();
            $table->string('market_phrase', 80)->nullable();
            $table->integer("owner_id")->unsigned()->nullable();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_players');
    }
}
