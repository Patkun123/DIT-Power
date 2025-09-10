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
        Schema::create('scramble_rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scramble_attempt_id')->constrained()->cascadeOnDelete();
            $table->string('target');
            $table->string('guess')->nullable();
            $table->boolean('solved')->default(false);
            $table->unsignedInteger('time')->default(0); // seconds
            $table->unsignedInteger('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scramble_rounds');
    }
};




