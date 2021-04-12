<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('averages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->string('type');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('averages');
    }
}
