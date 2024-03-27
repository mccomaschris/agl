<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::create('notes', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('player_id')->unsigned();
			$table->text('note');
			$table->boolean('active')->default(true);
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            Schema::dropIfExists('notes');
        });
    }
};
