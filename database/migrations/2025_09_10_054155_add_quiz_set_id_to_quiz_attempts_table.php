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
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->foreignId('quiz_set_id')->nullable()->constrained('quiz_sets')->onDelete('cascade')->after('quiz_id');
            $table->index('quiz_set_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropForeign(['quiz_set_id']);
            $table->dropIndex(['quiz_set_id']);
            $table->dropColumn('quiz_set_id');
        });
    }
};