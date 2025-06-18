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
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 5, 1); // Berat badan dalam kg (misalnya, 70.5)
            $table->date('log_date'); // Tanggal input
            // $table->timestamp('created_at')->useCurrent();
            $table->unique(['user_id', 'log_date'], 'user_weight_log_unique'); // Satu input per hari
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weight_logs');
    }
};
