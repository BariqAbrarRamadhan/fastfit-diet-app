<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meal_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('meal_type'); // breakfast, lunch, dinner, snack
            $table->string('meal_name');
            $table->integer('calories');
            $table->text('description')->nullable();
            $table->date('log_date');
            $table->timestamps();

            $table->unique(['user_id', 'meal_type', 'log_date']); // Prevent duplicate meals per day
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_logs');
    }
};
