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
        Schema::create('upcoming_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('category')->default('General');
            $table->string('status')->default('draft'); // draft, published, inactive, archived
            $table->datetime('event_date');
            $table->datetime('end_date')->nullable();
            $table->string('location')->nullable();
            $table->string('organizer')->nullable();
            $table->string('author')->nullable();
            $table->string('image_url')->nullable();
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->timestamps();

            $table->index(['status', 'event_date']);
            $table->index('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcoming_events');
    }
};
