<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelegramSourceInGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->enum('telegram_source', ['production', 'testing'])->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('telegram_source');
        });
    }
}
