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
        Schema::create('exercise_recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Exercise name
            $table->text('description'); // Exercise description
            $table->string('category'); // cardio, strength, flexibility, etc.
            $table->enum('goal', ['weight_loss', 'muscle_gain', 'maintain_weight']); // Goal of the exercise
            $table->string('image')->nullable(); // Image URL for the exercise
            $table->enum('activity_level', ['sedentary', 'lightly_active', 'moderately_active', 'very_active', 'extra_active']); // Activity level
            $table->integer('duration_minutes'); // Recommended duration in minutes
            $table->integer('frequency_per_week'); // How many times per week
            $table->text('instructions')->nullable(); // How to perform the exercise
            $table->text('benefits')->nullable(); // Benefits of the exercise
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced']); // beginner, intermediate, advanced
            $table->integer('calories_burned_per_hour')->nullable(); // Estimated calories burned
            $table->text('equipment_needed')->nullable(); // Equipment required
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_recommendations');
    }
};
