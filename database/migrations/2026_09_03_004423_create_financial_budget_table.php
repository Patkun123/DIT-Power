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
        Schema::create('financial_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('category'); // Food, Transport, Utilities, etc.
            $table->decimal('monthly_budget', 15, 2);
            $table->year('year');
            $table->tinyInteger('month'); // 1-12
            $table->timestamps();

            $table->index(['user_id', 'year', 'month']);
            $table->unique(['user_id', 'category', 'year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_budgets');
    }
};
