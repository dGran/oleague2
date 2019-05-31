<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("group_id")->unsigned();

            $table->boolean("predefined_rounds")->default(true);
            $table->integer("rounds")->nullable();

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
        Schema::dropIfExists('playoffs');
    }
}
