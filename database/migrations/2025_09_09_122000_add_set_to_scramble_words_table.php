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
        Schema::table('scramble_words', function (Blueprint $table) {
            $table->unsignedTinyInteger('set')->default(1)->after('word');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scramble_words', function (Blueprint $table) {
            $table->dropColumn('set');
        });
    }
};




