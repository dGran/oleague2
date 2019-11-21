<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameLoseAmountColumnInPlayoffsRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_rounds', function (Blueprint $table) {
            $table->renameColumn('lose_amount', 'play_ontime_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playoffs_rounds', function (Blueprint $table) {
            $table->renameColumn('play_ontime_amount', 'lose_amount');
        });
    }
}
