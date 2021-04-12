<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('score_type');
            $table->integer('foreign_key')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->boolean('absent')->default(false);
            $table->boolean('injury')->default(false);
            $table->boolean('substitute')->default(false);
            $table->decimal('hole_1', 9, 5)->nullable();
            $table->decimal('hole_2', 9, 5)->nullable();
            $table->decimal('hole_3', 9, 5)->nullable();
            $table->decimal('hole_4', 9, 5)->nullable();
            $table->decimal('hole_5', 9, 5)->nullable();
            $table->decimal('hole_6', 9, 5)->nullable();
            $table->decimal('hole_7', 9, 5)->nullable();
            $table->decimal('hole_8', 9, 5)->nullable();
            $table->decimal('hole_9', 9, 5)->nullable();
            $table->integer('points')->nullable();
            $table->decimal('gross', 9, 5)->nullable();
            $table->decimal('gross_par', 9, 5)->nullable();
            $table->decimal('net', 9, 5)->nullable();
            $table->decimal('net_par', 9, 5)->nullable();
            $table->integer('eagle')->nullable();
            $table->integer('birdie')->nullable();
            $table->integer('par')->nullable();
            $table->integer('bogey')->nullable();
            $table->integer('double_bogey')->nullable();
            $table->float('current_average', 8, 6)->default(0.0);
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
        Schema::dropIfExists('scores');
    }
}
