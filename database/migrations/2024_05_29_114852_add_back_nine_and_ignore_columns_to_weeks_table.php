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
        Schema::table('weeks', function (Blueprint $table) {
            $table->boolean('ignore_scores')->default(false)->after('score_file');
            $table->boolean('back_nine')->default(false)->after('ignore_scores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weeks', function (Blueprint $table) {
            $table->dropColumn('ignore_scores');
			$table->dropColumn('back_nine');
        });
    }
};
