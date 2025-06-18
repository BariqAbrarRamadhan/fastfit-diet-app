<?php

namespace Database\Seeders;

use App\Models\ExerciseRecommendation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            // Weight Loss - Sedentary Level
            [
                'name' => 'Jalan Kaki Santai',
                'description' => 'Aktivitas kardio ringan yang cocok untuk pemula. Membantu meningkatkan kesehatan jantung dan membakar kalori dengan intensitas rendah.',
                'category' => 'cardio',
                'goal' => 'weight_loss',
                'activity_level' => 'sedentary',
                'duration_minutes' => 20,
                'frequency_per_week' => 3,
                'instructions' => "1. Kenakan sepatu olahraga yang nyaman\n2. Mulai dengan pemanasan 5 menit\n3. Jalan dengan kecepatan sedang\n4. Jaga postur tubuh tegak\n5. Akhiri dengan pendinginan 5 menit",
                'benefits' => "Meningkatkan kesehatan jantung, membakar kalori, mengurangi stress, memperbaiki mood",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 200,
                'equipment_needed' => 'Sepatu olahraga yang nyaman',
                'is_active' => true,
            ],
            [
                'name' => 'Stretching Ringan',
                'description' => 'Latihan peregangan untuk meningkatkan fleksibilitas dan mengurangi ketegangan otot.',
                'category' => 'flexibility',
                'goal' => 'weight_loss',
                'activity_level' => 'sedentary',
                'duration_minutes' => 15,
                'frequency_per_week' => 5,
                'instructions' => "1. Lakukan peregangan leher, bahu, dan punggung\n2. Tahan setiap gerakan 15-30 detik\n3. Bernafas dalam-dalam saat melakukan\n4. Jangan memaksakan gerakan",
                'benefits' => "Meningkatkan fleksibilitas, mengurangi ketegangan otot, memperbaiki postur tubuh",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 120,
                'equipment_needed' => 'Matras yoga (opsional)',
                'is_active' => true,
            ],

            // Weight Loss - Lightly Active
            [
                'name' => 'Jogging Ringan',
                'description' => 'Latihan kardio menengah yang efektif untuk meningkatkan stamina dan membakar lemak.',
                'category' => 'cardio',
                'goal' => 'weight_loss',
                'activity_level' => 'lightly_active',
                'duration_minutes' => 30,
                'frequency_per_week' => 3,
                'instructions' => "1. Pemanasan dengan jalan kaki 5 menit\n2. Mulai jogging dengan kecepatan nyaman\n3. Jaga napas teratur\n4. Pertahankan postur tubuh\n5. Pendinginan dengan jalan santai",
                'benefits' => "Membakar lemak, meningkatkan stamina, memperkuat jantung, mengurangi berat badan",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 400,
                'equipment_needed' => 'Sepatu lari yang baik',
                'is_active' => true,
            ],
            [
                'name' => 'Latihan Kekuatan Dasar',
                'description' => 'Kombinasi latihan bodyweight untuk membangun otot dan membakar kalori.',
                'category' => 'strength',
                'goal' => 'weight_loss',
                'activity_level' => 'lightly_active',
                'duration_minutes' => 25,
                'frequency_per_week' => 2,
                'instructions' => "1. Push-up (10 repetisi)\n2. Squat (15 repetisi)\n3. Plank (30 detik)\n4. Lunges (10 per kaki)\n5. Istirahat 1 menit antar set\n6. Ulangi 3 set",
                'benefits' => "Membangun massa otot, meningkatkan metabolisme, memperbaiki komposisi tubuh",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 350,
                'equipment_needed' => 'Tidak ada (bodyweight)',
                'is_active' => true,
            ],

            // Muscle Gain - Moderately Active
            [
                'name' => 'Latihan Beban Compound',
                'description' => 'Latihan dengan gerakan compound yang melibatkan banyak grup otot untuk membangun massa otot.',
                'category' => 'strength',
                'goal' => 'muscle_gain',
                'activity_level' => 'moderately_active',
                'duration_minutes' => 45,
                'frequency_per_week' => 4,
                'instructions' => "1. Squat (3 set x 8-12 rep)\n2. Deadlift (3 set x 6-10 rep)\n3. Bench Press (3 set x 8-12 rep)\n4. Pull-up (3 set x 5-10 rep)\n5. Overhead Press (3 set x 8-12 rep)\n6. Istirahat 2-3 menit antar set",
                'benefits' => "Membangun massa otot, meningkatkan kekuatan, memperbaiki densitas tulang",
                'difficulty_level' => 'intermediate',
                'calories_burned_per_hour' => 450,
                'equipment_needed' => 'Barbell, dumbell, pull-up bar',
                'is_active' => true,
            ],
            [
                'name' => 'HIIT Training',
                'description' => 'High Intensity Interval Training untuk membakar lemak sambil mempertahankan massa otot.',
                'category' => 'hiit',
                'goal' => 'weight_loss',
                'activity_level' => 'very_active',
                'duration_minutes' => 20,
                'frequency_per_week' => 3,
                'instructions' => "1. Burpees (30 detik)\n2. Istirahat (10 detik)\n3. Mountain Climbers (30 detik)\n4. Istirahat (10 detik)\n5. Jump Squats (30 detik)\n6. Istirahat (10 detik)\n7. Ulangi siklus 6-8 kali",
                'benefits' => "Membakar kalori maksimal, meningkatkan metabolisme, menghemat waktu",
                'difficulty_level' => 'advanced',
                'calories_burned_per_hour' => 600,
                'equipment_needed' => 'Tidak ada (bodyweight)',
                'is_active' => true,
            ],

            // Maintain Weight
            [
                'name' => 'Bersepeda Outdoor',
                'description' => 'Aktivitas kardio yang menyenangkan sambil menikmati alam untuk menjaga kebugaran.',
                'category' => 'cardio',
                'goal' => 'maintain_weight',
                'activity_level' => 'moderately_active',
                'duration_minutes' => 60,
                'frequency_per_week' => 2,
                'instructions' => "1. Periksa kondisi sepeda dan helm\n2. Mulai dengan kecepatan rendah\n3. Tingkatkan kecepatan secara bertahap\n4. Jaga hidrasi selama bersepeda\n5. Pendinginan dengan kecepatan rendah",
                'benefits' => "Meningkatkan kesehatan kardiovaskular, memperkuat kaki, ramah lingkungan",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 400,
                'equipment_needed' => 'Sepeda, helm, botol minum',
                'is_active' => true,
            ],

            // Additional exercises for more comprehensive coverage
            [
                'name' => 'Bodyweight Circuit Training',
                'description' => 'Latihan sirkuit menggunakan berat tubuh sendiri untuk kombinasi kekuatan dan kardio.',
                'category' => 'mixed',
                'goal' => 'muscle_gain',
                'activity_level' => 'lightly_active',
                'duration_minutes' => 30,
                'frequency_per_week' => 3,
                'instructions' => "1. Push-ups (45 detik)\n2. Istirahat (15 detik)\n3. Squats (45 detik)\n4. Istirahat (15 detik)\n5. Burpees (45 detik)\n6. Istirahat (15 detik)\n7. Ulangi 4 siklus",
                'benefits' => "Meningkatkan kekuatan dan daya tahan, membakar lemak, efisien waktu",
                'difficulty_level' => 'intermediate',
                'calories_burned_per_hour' => 400,
                'equipment_needed' => 'Tidak ada (bodyweight)',
                'is_active' => true,
            ],
            [
                'name' => 'Functional Training',
                'description' => 'Latihan yang meniru gerakan sehari-hari untuk meningkatkan kekuatan fungsional.',
                'category' => 'strength',
                'goal' => 'maintain_weight',
                'activity_level' => 'very_active',
                'duration_minutes' => 35,
                'frequency_per_week' => 3,
                'instructions' => "1. Farmer's walk (2 menit)\n2. Turkish get-ups (5 per sisi)\n3. Medicine ball slams (30 detik)\n4. Battle ropes (30 detik)\n5. Box jumps (30 detik)\n6. Istirahat 1 menit antar exercise",
                'benefits' => "Meningkatkan kekuatan fungsional, koordinasi, power",
                'difficulty_level' => 'advanced',
                'calories_burned_per_hour' => 550,
                'equipment_needed' => 'Medicine ball, battle ropes, box jump',
                'is_active' => true,
            ],
            [
                'name' => 'Zumba Fitness',
                'description' => 'Latihan kardio yang menyenangkan dengan kombinasi tarian dan musik Latin.',
                'category' => 'cardio',
                'goal' => 'weight_loss',
                'activity_level' => 'moderately_active',
                'duration_minutes' => 45,
                'frequency_per_week' => 2,
                'instructions' => "1. Pemanasan dengan gerakan ringan\n2. Ikuti instruktur dengan gerakan salsa\n3. Variasi dengan merengue dan reggaeton\n4. Jaga energi tinggi sepanjang sesi\n5. Pendinginan dengan stretching",
                'benefits' => "Membakar kalori, meningkatkan koordinasi, mood booster, fun workout",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 450,
                'equipment_needed' => 'Musik, ruang yang cukup',
                'is_active' => true,
            ],
            [
                'name' => 'Resistance Band Training',
                'description' => 'Latihan kekuatan menggunakan resistance band yang portable dan serbaguna.',
                'category' => 'strength',
                'goal' => 'muscle_gain',
                'activity_level' => 'moderately_active',
                'duration_minutes' => 25,
                'frequency_per_week' => 4,
                'instructions' => "1. Bicep curls (3 set x 15 rep)\n2. Chest press (3 set x 12 rep)\n3. Lat pulldown (3 set x 12 rep)\n4. Leg press (3 set x 15 rep)\n5. Shoulder press (3 set x 12 rep)",
                'benefits' => "Membangun kekuatan, portable, aman untuk sendi, variasi resistensi",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 250,
                'equipment_needed' => 'Resistance bands set',
                'is_active' => true,
            ],

            // Maintain Weight - Sedentary Level
            [
                'name' => 'Peregangan Aktif di Rumah',
                'description' => 'Latihan peregangan ringan dan gerakan mobilitas untuk menjaga kebugaran dan mencegah kekakuan otot saat banyak duduk.',
                'category' => 'flexibility',
                'goal' => 'maintain_weight',
                'activity_level' => 'sedentary',
                'duration_minutes' => 20,
                'frequency_per_week' => 5,
                'instructions' => "1. Lakukan peregangan leher, bahu, punggung, dan kaki\n2. Setiap gerakan 20-30 detik\n3. Tambahkan gerakan mobilitas sendi\n4. Ulangi 2-3 set\n5. Lakukan di sela waktu kerja atau belajar",
                'benefits' => "Menjaga fleksibilitas, mencegah nyeri otot, meningkatkan sirkulasi darah",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 100,
                'equipment_needed' => 'Matras yoga (opsional)',
                'is_active' => true,
            ],
            [
                'name' => 'Senam Ringan di Rumah',
                'description' => 'Senam ringan seperti side step, arm circle, dan marching di tempat untuk menjaga berat badan dan kesehatan jantung.',
                'category' => 'cardio',
                'goal' => 'maintain_weight',
                'activity_level' => 'sedentary',
                'duration_minutes' => 15,
                'frequency_per_week' => 4,
                'instructions' => "1. Pemanasan 3 menit\n2. Marching di tempat 2 menit\n3. Side step 2 menit\n4. Arm circle 2 menit\n5. Pendinginan dan stretching 3 menit",
                'benefits' => "Meningkatkan sirkulasi, menjaga kebugaran, mudah dilakukan di rumah",
                'difficulty_level' => 'beginner',
                'calories_burned_per_hour' => 120,
                'equipment_needed' => 'Tidak ada',
                'is_active' => true,
            ],
        ];

        foreach ($exercises as $exercise) {
            ExerciseRecommendation::create($exercise);
        }
    }
}
