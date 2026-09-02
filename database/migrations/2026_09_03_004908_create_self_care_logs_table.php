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
        Schema::create('self_care_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('activity'); // exercise, meditation, sleep, nutrition, social, hobby
            $table->boolean('completed')->default(false);
            $table->date('log_date')->default(now());
            $table->timestamps();

            $table->index(['user_id', 'log_date']);
            $table->unique(['user_id', 'activity', 'log_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_care_logs');
    }
};
