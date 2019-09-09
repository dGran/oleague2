<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['default', 'transfer', 'result', 'press', 'duel', 'champion', 'birthday'])->index();
            $table->integer("transfer_id")->unsigned()->nullable();
            $table->integer("match_id")->unsigned()->nullable();
            $table->integer("press_id")->unsigned()->nullable();
            $table->string('category')->nullable()->index();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('img')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
