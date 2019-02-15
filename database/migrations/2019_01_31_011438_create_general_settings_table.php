<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->integer('active_season_id')->unsigned()->index();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->boolean('user_inscription')->default(1);
            $table->string('telegram_bot_token')->nullable();
            $table->string('telegram_channel_id')->nullable();
            $table->string('telegram_username_not')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
