<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteClashDestinyPositionColumnInPlayoffsRoundsClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_rounds_clashes', function (Blueprint $table) {
            $table->dropColumn('clash_destiny_position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playoffs_rounds_clashes', function (Blueprint $table) {
            $table->integer("clash_destiny_position")->nullable();
        });
    }
}
