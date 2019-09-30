<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("season_id")->unsigned();
            $table->integer("participant1_id")->unsigned();
            $table->integer("participant2_id")->unsigned();
            $table->decimal('cash1')->nullable();
            $table->decimal('cash2')->nullable();
            $table->enum('state', ['pending', 'blocked', 'confirmed', 'refushed'])->index();
            $table->boolean('cession')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
