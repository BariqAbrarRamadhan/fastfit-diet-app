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
        Schema::create('food_recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->json('diet_types'); // Array of diet types this food is suitable for
            $table->string('meal_type'); // breakfast, lunch, dinner, snack
            $table->integer('calories_per_serving')->nullable();
            $table->decimal('protein', 5, 2)->nullable(); // in grams
            $table->decimal('carbs', 5, 2)->nullable(); // in grams
            $table->decimal('fats', 5, 2)->nullable(); // in grams
            $table->text('ingredients')->nullable();
            $table->text('preparation_method')->nullable();
            $table->integer('prep_time')->nullable(); // in minutes
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_recommendations');
    }
};
