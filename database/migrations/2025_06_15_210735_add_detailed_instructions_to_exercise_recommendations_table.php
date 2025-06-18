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
            // Add JSON field for detailed step-by-step instructions with images
            $table->json('detailed_instructions')->nullable()->after('instructions');
            // Add JSON field for structured benefits
            $table->json('structured_benefits')->nullable()->after('benefits');
            // Add field for main exercise image
            $table->string('main_image')->nullable()->after('image');
            // Add field for exercise video URL
            $table->string('video_url')->nullable()->after('main_image');
            // Add field for muscle groups targeted
            $table->json('muscle_groups')->nullable()->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercise_recommendations', function (Blueprint $table) {
            $table->dropColumn(['detailed_instructions', 'structured_benefits', 'main_image', 'video_url', 'muscle_groups']);
        });
    }
};
