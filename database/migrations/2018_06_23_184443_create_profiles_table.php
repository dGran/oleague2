<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->string('avatar')->nullable();
            $table->string('signature')->nullable();
            $table->string('gamertag')->nullable();
            $table->string('slack_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('location')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('email_notifications')->default(1);
            $table->boolean('slack_notifications')->default(1);
            $table->timestamps();

            $table->primary('user_id');
            $table->index('gamertag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
