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
        Schema::create('exercise_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_recommendation_id')->nullable()->constrained('exercise_recommendations')->onDelete('set null');
            $table->string('exercise_name');
            $table->text('exercise_description')->nullable();
            $table->integer('duration_minutes');
            $table->enum('intensity', ['low', 'moderate', 'high'])->default('moderate');
            $table->integer('calories_burned')->nullable();
            $table->text('notes')->nullable();
            $table->date('log_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_logs');
    }
};
