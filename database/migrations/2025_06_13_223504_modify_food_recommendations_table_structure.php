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
        Schema::table('food_recommendations', function (Blueprint $table) {
            // Add day field for scheduling (monday, tuesday, etc.)
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->nullable()->after('meal_type');

            // Remove unnecessary nutritional and recipe fields
            $table->dropColumn([
                'protein',
                'carbs',
                'fats',
                'ingredients',
                'preparation_method',
                'prep_time',
                'difficulty'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_recommendations', function (Blueprint $table) {
            // Remove day field
            $table->dropColumn('day');

            // Re-add the removed fields
            $table->decimal('protein', 5, 2)->nullable();
            $table->decimal('carbs', 5, 2)->nullable();
            $table->decimal('fats', 5, 2)->nullable();
            $table->text('ingredients')->nullable();
            $table->text('preparation_method')->nullable();
            $table->integer('prep_time')->nullable();
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
        });
    }
};
