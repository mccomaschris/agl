<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->integer('year_id')->nullable();
            $table->boolean('temp_player')->default(false);
            $table->integer('position')->default(0);
            $table->integer('hc_current')->default(0);
            $table->integer('hc_first')->default(0);
            $table->integer('hc_second')->default(0);
            $table->integer('hc_third')->default(0);
            $table->integer('hc_fourth')->default(0);
            $table->integer('hc_playoff')->default(0);
            $table->integer('hc_next_year')->default(0);
            $table->integer('hc_18')->default(0);
            $table->decimal('hc_full', 8, 5)->default(0);
            $table->integer('hc_full_rank')->default(0);
            $table->integer('won')->default(0);
            $table->integer('lost')->default(0);
            $table->integer('tied')->default(0);
            $table->float('win_pct', 8, 7)->default(0.0);
            $table->integer('points')->default(0);
            $table->integer('points_rank')->default(0);
            $table->integer('wins_rank')->default(0);
            $table->float('gross_average', 8, 6)->default(0.0);
            $table->float('gross_par', 8, 6)->default(0.0);
            $table->float('net_average', 8, 6)->default(0.0);
            $table->float('net_par', 8, 6)->default(0.0);
            $table->integer('low_gross')->default(0);
            $table->integer('high_gross')->default(0);
            $table->integer('low_net')->default(0);
            $table->integer('high_net')->default(0);
            $table->integer('position_net_rank')->default(0);
            $table->integer('overall_net_rank')->default(0);
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
        Schema::dropIfExists('players');
    }
}
