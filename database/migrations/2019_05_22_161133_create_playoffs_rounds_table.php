<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayoffsRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("playoff_id")->unsigned();
            $table->string("name");
            $table->boolean("round_trip")->default(false);
            $table->boolean("double_value")->default(false);
            $table->dateTime('date_limit')->nullable();
            $table->float('play_amount', 8, 2)->nullable();
            $table->float('win_amount', 8, 2)->nullable();
            $table->float('lose_amount', 8, 2)->nullable();

            $table->index('playoff_id', 'playoff_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_rounds');
    }
}
