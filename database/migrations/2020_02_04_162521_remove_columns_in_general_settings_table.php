<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsInGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('telegram_bot_token');
            $table->dropColumn('telegram_channel_id');
            $table->dropColumn('telegram_username_not');
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
            $table->string('telegram_bot_token')->nullable();
            $table->string('telegram_channel_id')->nullable();
            $table->string('telegram_username_not')->nullable();
        });
    }
}
