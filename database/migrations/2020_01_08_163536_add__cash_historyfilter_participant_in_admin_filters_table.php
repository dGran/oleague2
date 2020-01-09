<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashHistoryfilterParticipantInAdminFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_filters', function (Blueprint $table) {
            $table->string("seasonCashHistory_filterParticipant")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_filters', function (Blueprint $table) {
            $table->dropColumn('seasonCashHistory_filterParticipant');
        });
    }
}
