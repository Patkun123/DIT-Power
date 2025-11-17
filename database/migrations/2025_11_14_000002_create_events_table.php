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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->date('event_date');
            $table->time('event_time');
            $table->enum('status', ['active', 'cancelled', 'completed'])->default('active');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('event_date');
            $table->index('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
