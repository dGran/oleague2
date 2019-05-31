<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayoffsRoundsClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds_clashes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("round_id")->unsigned();

            $table->integer("order")->default(1);
            $table->integer("local_id")->unsigned()->nullable();
            $table->integer("local_user_id")->unsigned()->nullable();
            $table->integer("local_score")->nullable();
            $table->integer("visitor_id")->unsigned()->nullable();
            $table->integer("visitor_user_id")->unsigned()->nullable();
            $table->integer("visitor_score")->nullable();
            $table->integer("sanctioned_id")->unsigned()->nullable();

            $table->integer("table_position")->nullable();
            $table->integer("clash_destiny_id")->nullable();
            $table->integer("clash_destiny_position")->nullable();

            $table->dateTime('date_limit')->nullable();
            $table->boolean('active')->default(false);

            $table->index('round_id', 'round_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_rounds_clashes');
    }
}
