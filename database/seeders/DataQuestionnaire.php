<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataQuestionnaire extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questionnaires')->insert([
            [
                'user_id' => 3,
                'goal' => 'weight_loss',
                'gender' => 'pria',
                'age' => 25,
                'height' => 175,
                'weight' => 80,
                'target_weight' => 70,
                'activity_level' => 'sedentary',
                'is_heart_disease' => false,
                'is_hypertension' => false,
                'is_dyslipidemia' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
