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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('goal', ['weight_loss', 'maintain_weight', 'muscle_gain']);
            $table->enum('gender', ['pria', 'wanita']);
            $table->integer('age');
            $table->double('height');
            $table->double('weight');
            $table->double('target_weight');
            $table->enum('activity_level', ['sedentary', 'moderately_active', 'extra_active']);
            $table->boolean('is_heart_disease')->default(false);
            $table->boolean('is_hypertension')->default(false);
            $table->boolean('is_dyslipidemia')->default(false);
            $table->json('recommended_diets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire');
    }
};
