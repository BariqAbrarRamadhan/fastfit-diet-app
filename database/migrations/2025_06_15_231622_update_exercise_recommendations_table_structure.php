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
        Schema::table('exercise_recommendations', function (Blueprint $table) {
            // Drop columns yang tidak digunakan lagi
            $table->dropColumn([
                'muscle_groups',
                'main_image',
                'duration_minutes',
                'frequency_per_week',
                'detailed_instructions',
                'benefits',
                'structured_benefits',
                'difficulty_level',
                'equipment_needed'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercise_recommendations', function (Blueprint $table) {
            // Restore dropped columns
            $table->json('muscle_groups')->nullable();
            $table->string('main_image')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->integer('frequency_per_week')->nullable();
            $table->json('detailed_instructions')->nullable();
            $table->text('benefits')->nullable();
            $table->json('structured_benefits')->nullable();
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->nullable();
            $table->string('equipment_needed')->nullable();
        });
    }
};
