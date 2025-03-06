<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Year;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('team_week_points', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('team_id');
			$table->unsignedBigInteger('week_id');
			$table->integer('points');
			$table->integer('won');
			$table->integer('lost');
			$table->integer('tied');
			$table->foreign('team_id')->references('id')->on('teams');
			$table->foreign('week_id')->references('id')->on('weeks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_week_points');
    }
};
