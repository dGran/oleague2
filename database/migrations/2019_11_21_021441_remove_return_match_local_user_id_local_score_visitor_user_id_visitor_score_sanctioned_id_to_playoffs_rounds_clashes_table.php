<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveReturnMatchLocalUserIdLocalScoreVisitorUserIdVisitorScoreSanctionedIdToPlayoffsRoundsClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_rounds_clashes', function (Blueprint $table) {
            $table->dropColumn('return_match');
            $table->dropColumn('local_user_id');
            $table->dropColumn('local_score');
            $table->dropColumn('visitor_user_id');
            $table->dropColumn('visitor_score');
            $table->dropColumn('sanctioned_id');
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
            $table->boolean("return_match")->default(0);
            $table->integer("local_user_id")->unsigned()->nullable();
            $table->integer("local_score")->nullable();
            $table->integer("visitor_user_id")->unsigned()->nullable();
            $table->integer("visitor_score")->nullable();
            $table->integer("sanctioned_id")->unsigned()->nullable();
        });
    }
}
