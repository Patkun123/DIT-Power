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
        Schema::create('daily_winners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('winner_type'); // 'overall', 'set_1', 'set_2', 'set_3'
            $table->date('winner_date');
            $table->integer('score');
            $table->integer('correct_answers');
            $table->integer('attempts_count');
            $table->string('set_number')->nullable(); // For set-specific winners
            $table->timestamps();
            
            // Ensure one winner per type per date
            $table->unique(['winner_type', 'winner_date']);
            $table->index(['winner_date', 'winner_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_winners');
    }
};
