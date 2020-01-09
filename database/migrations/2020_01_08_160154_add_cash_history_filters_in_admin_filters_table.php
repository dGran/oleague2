<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashHistoryFiltersInAdminFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_filters', function (Blueprint $table) {
            $table->string("seasonCashHistory_filterSeason")->nullable();
            $table->string("seasonCashHistory_order")->nullable();
            $table->string("seasonCashHistory_pagination")->nullable();
            $table->string("seasonCashHistory_page")->nullable();
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
            $table->dropColumn('seasonCashHistory_filterSeason');
            $table->dropColumn('seasonCashHistory_order');
            $table->dropColumn('seasonCashHistory_pagination');
            $table->dropColumn('seasonCashHistory_page');
        });
    }
}
