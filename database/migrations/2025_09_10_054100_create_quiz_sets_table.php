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
        Schema::create('quiz_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->string('set_name'); // e.g., "Set 1", "Set 2", "Morning Session", "Afternoon Session"
            $table->integer('set_number'); // 1, 2, 3, 4, etc.
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->enum('status', ['scheduled', 'active', 'ended'])->default('scheduled');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index(['quiz_id', 'set_number']);
            $table->index(['start_time', 'end_time']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_sets');
    }
};