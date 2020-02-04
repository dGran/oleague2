<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelegramColumnsInGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('telegram_channel')->nullable();
            $table->string('telegram_admin')->nullable();
            $table->boolean('telegram_notifications')->default(1);
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
            $table->dropColumn('telegram_channel');
            $table->dropColumn('telegram_admin');
            $table->dropColumn('telegram_notifications');
        });
    }
}
