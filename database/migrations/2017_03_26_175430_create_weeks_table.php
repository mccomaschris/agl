<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id')->unsigned();
            $table->integer('week_order')->default(0);
            $table->date('week_date');
            $table->string('side_games');
            $table->integer('a_first_id')->unsigned();
            $table->integer('a_second_id')->unsigned();
            $table->integer('b_first_id')->unsigned();
            $table->integer('b_second_id')->unsigned();
            $table->integer('c_first_id')->unsigned();
            $table->integer('c_second_id')->unsigned();
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
        Schema::dropIfExists('weeks');
    }
}
