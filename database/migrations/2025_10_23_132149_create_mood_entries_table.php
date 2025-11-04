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
        Schema::create('mood_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('mood'); // excited, happy, content, neutral, tired, anxious, sad, angry
            $table->text('note')->nullable();
            $table->date('date')->default(now());
            $table->timestamps();

            $table->index(['user_id', 'date']);
            $table->index(['user_id', 'mood']);
            $table->unique(['user_id', 'date']); // One mood entry per user per day
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mood_entries');
    }
};
