<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WaterLog;
use App\Models\MealLog;
use App\Models\Article;
use App\Models\FoodRecommendation;
use App\Models\ExerciseRecommendation;
use App\Models\ExerciseLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Motivational quotes
        $motivationalQuotes = [
            "Kesehatan yang baik bukanlah sesuatu yang kita beli, melainkan tabungan yang kita bangun setiap hari.",
            "Perjalanan seribu mil dimulai dengan langkah pertama. Teruslah melangkah!",
            "Investasi terbaik yang bisa Anda lakukan adalah investasi pada kesehatan Anda.",
            "Kebiasaan kecil yang konsisten menghasilkan perubahan besar dari waktu ke waktu.",
            "Jangan bandingkan perjalanan Anda dengan orang lain. Fokus pada kemajuan Anda sendiri.",
        ];
        $user = auth()->user(); // Assuming user is authenticated
        $name = $user->name ?? 'User'; // Fallback to 'User' if not authenticated
        $today = Carbon::today();

        // Get latest weight entry (not just today's)
        $latestWeight = WeightLog::where('user_id', $user->id)
            ->orderBy('log_date', 'desc')
            ->first();

        // If no weight log exists, use questionnaire weight as fallback
        if ($latestWeight == null && isset($user->questionnaire->weight)) {
            $latestWeight = (object) ['weight' => $user->questionnaire->weight];
        }

        // Get today's weight specifically for daily tracking
        $currentWeight = WeightLog::where('user_id', $user->id)
            ->where('log_date', $today)
            ->first();

        // If no today's weight, use latest weight
        if ($currentWeight == null) {
            $currentWeight = $latestWeight;
        }

        // Berat badan kemarin
        $yesterday = Carbon::yesterday();
        $yesterdayWeight = WeightLog::where('user_id', $user->id)
            ->where('log_date', $yesterday)
            ->first();        // Hitung perubahan berat
        $weightChange = 0;
        if ($currentWeight && $yesterdayWeight) {
            $weightChange = $this->calculateWeightChange($currentWeight->weight, $yesterdayWeight->weight);
        }// Calculate BMI using latest available weight
        $bmi = null;
        if ($latestWeight && $user->questionnaire && $user->questionnaire->height > 0) {
            $heightInMeters = $user->questionnaire->height / 100;
            $bmi = $latestWeight->weight / ($heightInMeters * $heightInMeters);
            $bmi = round($bmi, 1); // Round to 1 decimal place for better display
        }
        $programRecommendation = $user->questionnaire->program_recommendation ?? 'Program Diet Seimbang'; // Fallback to default program        // Get today's water intake
        $todayWaterIntake = WaterLog::where('user_id', $user->id)
            ->where('log_date', $today)
            ->sum('volume');

        // Ensure it's an integer (database sum might return string)
        $todayWaterIntake = (int) $todayWaterIntake;

        // Default water goal (can be made configurable later)
        $waterGoal = 2500; // 2.5 liters in ml        // Sample user data
        $userData = [
            'name' => $name,
            'weight' => [
                'current' => $currentWeight ? $this->formatWeight($currentWeight->weight) : null,
                'yesterday' => $yesterdayWeight ? $this->formatWeight($yesterdayWeight->weight) : null,
                'change' => $weightChange,
                'target' => $user->questionnaire->target_weight ? $this->formatWeight($user->questionnaire->target_weight) : null,
            ],
            'waterIntake' => [
                'current' => $todayWaterIntake, // from database
                'goal' => $waterGoal, // configurable goal
            ],
            'bmi' => $bmi,
            'programRecommendation' => $programRecommendation,
            'exerciseRecommendation' => 'Kardio (30 menit, 3x seminggu) & Latihan Kekuatan (2x seminggu)',
            'dailyProgress' => $this->generateDailyProgressWithMeals($programRecommendation),
        ];        // Get real articles from database
        $articles = Article::orderBy('created_at', 'desc')
            ->limit(4)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => $article->excerpt,
                    'image' => $article->image ? asset('storage/' . $article->image) : '/placeholder.svg?height=200&width=300',
                    'category' => $article->category,
                    'readTime' => $article->read_time ? $article->read_time . ' menit' : '5 menit',
                    'slug' => $article->slug ?? null,
                ];
            })
            ->toArray();        // Get food recommendations based on user's diet recommendations
        $foodRecommendations = $this->getFoodRecommendationsForUser($user);        // Get exercise recommendations based on user's diet recommendations
        $exerciseRecommendations = $this->getExerciseRecommendationsForUser($user);

        // Get user's exercise statistics
        $exerciseStats = $this->getUserExerciseStats($user);

        // Water volume options
        $waterVolumeOptions = [
            ['label' => '100ml', 'value' => 100],
            ['label' => '250ml', 'value' => 250],
            ['label' => '500ml', 'value' => 500],
            ['label' => '1000ml', 'value' => 1000],
        ];// Random quote
        $quote = $motivationalQuotes[array_rand($motivationalQuotes)];        // Find today's index in daily progress (it should be at index 3 since we generate -3 to +3 days)
        $todayIndex = 3; // Today is always at index 3 in our 7-day array
        $currentDay = session('currentDay', $todayIndex); // Default to today

        // Debug logging
        \Log::info('Dashboard currentDay debug', [
            'session_current_day' => session('currentDay'),
            'final_current_day' => $currentDay,
            'today_index' => $todayIndex
        ]);

        // Ensure currentDay is within valid range
        $currentDay = max(0, min(6, $currentDay));

        $selectedDay = $userData['dailyProgress'][$currentDay];
        $waterAmount = $userData['waterIntake']['current'];
        $selectedWaterVolume = 250; // Default
        $carouselIndex = session('carouselIndex', 0); // Default for articles
        $articlesPerPage = 2;
        $visibleArticles = array_slice($articles, $carouselIndex, $articlesPerPage);
        return view('user.dashboard', compact(
            'userData',
            'quote',
            'articles',
            'foodRecommendations',
            'exerciseRecommendations',
            'exerciseStats',
            'waterVolumeOptions',
            'currentDay',
            'selectedDay',
            'waterAmount',
            'selectedWaterVolume',
            'visibleArticles',
            'carouselIndex',
            'articlesPerPage'
        ));
    }
    public function prevDay(Request $request)
    {
        $currentDay = session('currentDay', 3); // Today is at index 3
        $newDay = max(0, $currentDay - 1);
        session(['currentDay' => $newDay]);
        return redirect()->route('dashboard');
    }

    public function nextDay(Request $request)
    {
        $currentDay = session('currentDay', 3); // Today is at index 3
        $newDay = min(6, $currentDay + 1); // Max 6 (7 days: 0-6)
        session(['currentDay' => $newDay]);
        return redirect()->route('dashboard');
    }
    public function setDay(Request $request)
    {
        $dayIndex = $request->input('day_index', 3); // Default to today (index 3)

        // Validate that day_index is within valid range (0-6)
        $dayIndex = max(0, min(6, (int) $dayIndex));

        // Debug logging
        \Log::info('Setting day in session', [
            'old_current_day' => session('currentDay'),
            'new_day_index' => $dayIndex,
            'request_day_index' => $request->input('day_index')
        ]);

        session(['currentDay' => $dayIndex]);

        // Verify the session was set
        \Log::info('Day set in session', [
            'current_day_after_set' => session('currentDay')
        ]);

        return redirect()->route('dashboard')->with('success', 'Hari berhasil dipilih');
    }

    public function saveWeight(Request $request)
    {
        $today = Carbon::today();
        $userId = Auth::id();

        // Cek apakah sudah input hari ini
        $existingLog = WeightLog::where('user_id', $userId)
            ->where('log_date', $today)
            ->first();

        if ($existingLog) {
            return redirect()->back()->with('error', 'Anda sudah menginput berat badan hari ini.');
        }        // Validasi input
        $request->validate([
            'weight' => 'required|numeric|min:30|max:300', // Berat badan 30–300 kg
        ]);

        // Format weight properly to avoid floating point issues
        $formattedWeight = $this->formatWeight($request->weight);

        // Simpan berat badan
        WeightLog::create([
            'user_id' => $userId,
            'weight' => $formattedWeight,
            'log_date' => $today,
        ]);

        return redirect()->back()->with('success', 'Berat badan berhasil disimpan!');
    }

    public function selectWaterVolume(Request $request)
    {
        // Store selected volume
        ['selectedWaterVolume' => $request->input('volume')];
        return redirect()->route('dashboard');
    }
    public function addWater(Request $request)
    {
        $request->validate([
            'volume' => 'required|integer|min:1|max:2000',
        ]);

        $today = Carbon::today();
        $userId = Auth::id();

        // Create water log entry
        WaterLog::create([
            'user_id' => $userId,
            'volume' => $request->volume,
            'log_date' => $today,
        ]);

        return redirect()->back()->with('success', 'Air minum berhasil ditambahkan: ' . $request->volume . 'ml');
    }

    public function resetWater(Request $request)
    {
        $today = Carbon::today();
        $userId = Auth::id();

        // Delete all water logs for today
        WaterLog::where('user_id', $userId)
            ->where('log_date', $today)
            ->delete();

        return redirect()->back()->with('success', 'Data air minum hari ini berhasil direset.');
    }

    public function reduceWater(Request $request)
    {
        // Decrement water amount
        // $waterAmount = 'waterAmount', 1500 - 'selectedWaterVolume', 250;
        $waterAmount = 1500 - 250;
        ['waterAmount' => max($waterAmount, 0)];
        return redirect()->route('dashboard');
    }
    public function prevArticles(Request $request)
    {
        $carouselIndex = session('carouselIndex', 0);
        $articlesPerPage = 2;
        $newIndex = max(0, $carouselIndex - $articlesPerPage);
        session(['carouselIndex' => $newIndex]);
        return redirect()->route('dashboard');
    }
    public function nextArticles(Request $request)
    {
        $carouselIndex = session('carouselIndex', 0);
        $totalArticles = Article::count();
        $articlesPerPage = 2;
        $maxIndex = max(0, $totalArticles - $articlesPerPage);
        $newIndex = min($maxIndex, $carouselIndex + $articlesPerPage);
        session(['carouselIndex' => $newIndex]);
        return redirect()->route('dashboard');
    }

    public function consumeMeal(Request $request)
    {
        $request->validate([
            'meal_type' => 'required|string|in:breakfast,lunch,dinner,snack',
            'date' => 'required|date'
        ]);

        $userId = Auth::id();
        $user = auth()->user();
        $date = Carbon::parse($request->date);

        // Get meal details from the meal plan
        $programRecommendation = $user->questionnaire->program_recommendation ?? 'Program Diet Seimbang';
        $mealPlans = $this->getMealPlansByProgram($programRecommendation);
        $mealType = $request->meal_type;

        if (!isset($mealPlans[$mealType])) {
            return redirect()->back()->with('error', 'Jenis makanan tidak ditemukan.');
        }

        $meal = $mealPlans[$mealType];

        // Check if meal already consumed for this date
        $existingLog = MealLog::where('user_id', $userId)
            ->where('meal_type', $mealType)
            ->where('log_date', $date)
            ->first();

        if ($existingLog) {
            // Remove meal consumption
            $existingLog->delete();
            return redirect()->back()->with('success', 'Makanan berhasil dihapus dari konsumsi hari ini.');
        } else {
            // Add meal consumption
            MealLog::create([
                'user_id' => $userId,
                'meal_type' => $mealType,
                'meal_name' => $meal['name'],
                'calories' => $meal['calories'],
                'description' => $meal['description'],
                'log_date' => $date,
            ]);
            return redirect()->back()->with('success', 'Makanan berhasil ditandai sebagai dikonsumsi!');
        }
    }    /**
         * Generate daily progress with recommended meals based on diet program
         */
    private function generateDailyProgressWithMeals($programRecommendation)
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Generate 7 days: 3 days before, today, 3 days after
        $progressDays = [];
        for ($i = -3; $i <= 3; $i++) {
            $date = $today->copy()->addDays($i);
            $isToday = $i === 0;
            $dayName = $this->getIndonesianDayName($date->format('w'));

            // Get real data for weight and water
            $weightData = WeightLog::where('user_id', $user->id)
                ->where('log_date', $date)
                ->first();

            $waterData = WaterLog::where('user_id', $user->id)
                ->where('log_date', $date)
                ->sum('volume');

            // Get consumed meals for this date
            $consumedMeals = MealLog::where('user_id', $user->id)
                ->where('log_date', $date)
                ->get()
                ->keyBy('meal_type');

            // Get meal plans for this specific day and diet program
            $mealPlans = $this->getMealPlansForDay($programRecommendation, $dayName);

            // Merge meal plans with consumed status
            $mealsWithStatus = [];
            foreach ($mealPlans as $mealType => $meal) {
                $mealsWithStatus[$mealType] = $meal;
                $mealsWithStatus[$mealType]['consumed'] = isset($consumedMeals[$mealType]);
                $mealsWithStatus[$mealType]['consumed_at'] = isset($consumedMeals[$mealType]) ? $consumedMeals[$mealType]->created_at : null;
            }

            $progressDays[] = [
                'date' => $date->format('j'), // Day number
                'full_date' => $date->format('Y-m-d'), // Full date for backend
                'day' => $dayName, // Indonesian day name
                'weight' => $weightData ? $this->formatWeight($weightData->weight) : null,
                'water' => $waterData > 0 ? (int) $waterData : null,
                'current' => $isToday,
                'meals' => $mealsWithStatus
            ];
        }

        return $progressDays;
    }

    /**
     * Get Indonesian day names
     */
    private function getIndonesianDayName($dayNumber)
    {
        $days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        return $days[$dayNumber];
    }

    /**
     * Get meal plans for a specific day from database, with fallback to static data
     */
    private function getMealPlansForDay($programRecommendation, $dayName)
    {
        // Convert Indonesian day name to English day name for database query
        $englishDay = $this->convertToEnglishDay($dayName);

        // Get diet types based on program recommendation
        $dietTypes = $this->mapProgramToDietTypes($programRecommendation);

        // Try to get meals from database for this specific day
        $mealPlans = [];
        $mealTypes = ['breakfast', 'lunch', 'dinner', 'snack'];

        foreach ($mealTypes as $mealType) {
            // Query database for this meal type, day, and diet types
            $dbMeal = FoodRecommendation::active()
                ->forDay($englishDay)
                ->forMealType($mealType)
                ->where(function ($query) use ($dietTypes) {
                    foreach ($dietTypes as $dietType) {
                        $query->orWhereJsonContains('diet_types', $dietType);
                    }
                })
                ->inRandomOrder()
                ->first();

            if ($dbMeal) {
                // Use database meal
                $mealPlans[$mealType] = [
                    'name' => $dbMeal->name,
                    'calories' => $dbMeal->calories_per_serving ?? 0,
                    'description' => $dbMeal->description,
                    'icon' => $this->getMealTypeIcon($mealType),
                    'image' => $dbMeal->image
                ];
            } else {
                // Fallback to static data if no database meal found
                $fallbackMeals = $this->getFallbackMealPlans($programRecommendation);
                if (isset($fallbackMeals[$mealType])) {
                    $mealPlans[$mealType] = $fallbackMeals[$mealType];
                }
            }
        }

        // If no meals found at all, return complete fallback
        if (empty($mealPlans)) {
            return $this->getFallbackMealPlans($programRecommendation);
        }

        return $mealPlans;
    }

    /**
     * Convert Indonesian day name to English day name for database query
     */
    private function convertToEnglishDay($indonesianDay)
    {
        $dayMapping = [
            'Min' => 'sunday',
            'Sen' => 'monday',
            'Sel' => 'tuesday',
            'Rab' => 'wednesday',
            'Kam' => 'thursday',
            'Jum' => 'friday',
            'Sab' => 'saturday'
        ];

        return $dayMapping[$indonesianDay] ?? 'monday';
    }    /**
         * Map program recommendation to diet types for database query
         */
    private function mapProgramToDietTypes($programRecommendation)
    {
        // Handle empty program recommendation by checking user goal
        if (empty($programRecommendation)) {
            $user = auth()->user();
            if ($user && $user->questionnaire && $user->questionnaire->goal) {
                $goal = $user->questionnaire->goal;
                // Map goal to program recommendation
                $goalToProgram = [
                    'weight_loss' => 'weight_loss',
                    'weight_gain' => 'weight_gain',
                    'maintain_weight' => 'balanced',
                    'muscle_gain' => 'weight_gain',
                    'improve_health' => 'balanced'
                ];
                $programRecommendation = $goalToProgram[$goal] ?? 'balanced';
            } else {
                $programRecommendation = 'balanced';
            }
        }

        // Normalize program recommendation string
        $programLower = strtolower($programRecommendation);

        // Check for keywords to determine diet type
        if (str_contains($programLower, 'dash')) {
            return ['dash', 'heart_healthy', 'low_sodium'];
        } elseif (str_contains($programLower, 'mediterania') || str_contains($programLower, 'mediterranean')) {
            return ['mediterranean', 'heart_healthy'];
        } elseif (str_contains($programLower, 'rendah karbohidrat') || str_contains($programLower, 'low carb') || str_contains($programLower, 'keto')) {
            return ['low_carb', 'keto'];
        } elseif (str_contains($programLower, 'vegetarian')) {
            return ['vegetarian', 'plant_based'];
        } elseif (str_contains($programLower, 'vegan')) {
            return ['vegan', 'plant_based'];
        } elseif (str_contains($programLower, 'diabetic') || str_contains($programLower, 'diabetes')) {
            return ['diabetic', 'low_sugar', 'balanced'];
        }

        // For other cases, check user goal to determine appropriate diet
        $user = auth()->user();
        if ($user && $user->questionnaire && $user->questionnaire->goal) {
            $goal = $user->questionnaire->goal;

            if ($goal === 'weight_loss') {
                return ['weight_loss', 'low_calorie'];
            } elseif ($goal === 'weight_gain' || $goal === 'muscle_gain') {
                return ['weight_gain', 'high_protein'];
            }
        }

        // Default fallback
        return ['balanced', 'general'];
    }

    /**
     * Get meal type icon
     */
    private function getMealTypeIcon($mealType)
    {
        $iconMapping = [
            'breakfast' => 'sunrise',
            'lunch' => 'sun',
            'dinner' => 'moon',
            'snack' => 'coffee'
        ];

        return $iconMapping[$mealType] ?? 'utensils';
    }

    /**
     * Get fallback meal plans when database is empty
     */
    private function getFallbackMealPlans($programRecommendation)
    {
        return $this->getMealPlansByProgram($programRecommendation);
    }

    /**
     * Get meal plans based on diet program recommendation
     */
    private function getMealPlansByProgram($programRecommendation)
    {
        $mealPlans = [
            // Diet DASH - Untuk hipertensi dan kesehatan jantung
            'dash' => [
                'breakfast' => [
                    'name' => 'Oatmeal dengan Pisang & Kacang',
                    'calories' => 320,
                    'description' => 'Oatmeal whole grain dengan pisang, almond, dan susu rendah lemak (rendah natrium)',
                    'icon' => 'sunrise'
                ],
                'lunch' => [
                    'name' => 'Salad Quinoa dengan Ayam',
                    'calories' => 420,
                    'description' => 'Quinoa dengan ayam tanpa kulit, sayuran segar, dan dressing lemon (tanpa garam tambahan)',
                    'icon' => 'sun'
                ],
                'dinner' => [
                    'name' => 'Ikan Panggang & Sayuran Kukus',
                    'calories' => 380,
                    'description' => 'Ikan salmon panggang dengan brokoli, wortel kukus, dan kentang panggang (rendah natrium)',
                    'icon' => 'moon'
                ],
                'snack' => [
                    'name' => 'Buah & Yogurt Rendah Lemak',
                    'calories' => 150,
                    'description' => 'Yogurt plain rendah lemak dengan potongan buah berry dan granola',
                    'icon' => 'coffee'
                ]
            ],

            // Diet Mediterania - Untuk kesehatan jantung dan umum
            'mediterranean' => [
                'breakfast' => [
                    'name' => 'Roti Gandum dengan Alpukat',
                    'calories' => 350,
                    'description' => 'Roti gandum utuh dengan alpukat, tomat, dan minyak zaitun extra virgin',
                    'icon' => 'sunrise'
                ],
                'lunch' => [
                    'name' => 'Salad Mediterania dengan Ikan',
                    'calories' => 450,
                    'description' => 'Salad sayuran dengan ikan tuna, olive, keju feta, dan dressing minyak zaitun',
                    'icon' => 'sun'
                ],
                'dinner' => [
                    'name' => 'Pasta Whole Wheat dengan Seafood',
                    'calories' => 480,
                    'description' => 'Pasta gandum utuh dengan seafood, tomat, dan herbs dengan minyak zaitun',
                    'icon' => 'moon'
                ],
                'snack' => [
                    'name' => 'Kacang & Buah Kering',
                    'calories' => 180,
                    'description' => 'Campuran kacang almond, walnut, dan buah kering tanpa gula tambahan',
                    'icon' => 'coffee'
                ]
            ],

            // Diet Rendah Lemak - Untuk dislipidemia
            'low_fat' => [
                'breakfast' => [
                    'name' => 'Sereal Whole Grain & Susu Skim',
                    'calories' => 280,
                    'description' => 'Sereal whole grain dengan susu skim dan potongan buah segar',
                    'icon' => 'sunrise'
                ],
                'lunch' => [
                    'name' => 'Ayam Rebus & Nasi Merah',
                    'calories' => 400,
                    'description' => 'Ayam tanpa kulit direbus dengan nasi merah dan sayuran rebus (tanpa minyak)',
                    'icon' => 'sun'
                ],
                'dinner' => [
                    'name' => 'Ikan Kukus & Sayuran',
                    'calories' => 350,
                    'description' => 'Ikan kakap kukus dengan sayuran hijau dan kentang rebus (rendah lemak)',
                    'icon' => 'moon'
                ],
                'snack' => [
                    'name' => 'Buah Segar',
                    'calories' => 120,
                    'description' => 'Potongan buah segar seperti apel, pear, atau melon tanpa tambahan',
                    'icon' => 'coffee'
                ]
            ],

            // Diet Rendah Karbohidrat - Untuk penurunan berat badan
            'low_carb' => [
                'breakfast' => [
                    'name' => 'Telur Dadar & Sayuran',
                    'calories' => 320,
                    'description' => 'Telur dadar dengan bayam, paprika, dan keju cottage (rendah karbohidrat)',
                    'icon' => 'sunrise'
                ],
                'lunch' => [
                    'name' => 'Salad Protein dengan Daging',
                    'calories' => 450,
                    'description' => 'Salad hijau dengan daging sapi lean, alpukat, dan dressing olive oil',
                    'icon' => 'sun'
                ],
                'dinner' => [
                    'name' => 'Ayam Panggang & Brokoli',
                    'calories' => 380,
                    'description' => 'Ayam breast panggang dengan brokoli dan cauliflower panggang',
                    'icon' => 'moon'
                ],
                'snack' => [
                    'name' => 'Keju & Kacang',
                    'calories' => 160,
                    'description' => 'Keju cottage dengan kacang almond atau walnut',
                    'icon' => 'coffee'
                ]
            ],

            // Pola Makan Seimbang - Untuk maintenance umum
            'balanced' => [
                'breakfast' => [
                    'name' => 'Nasi Merah & Telur Rebus',
                    'calories' => 380,
                    'description' => 'Nasi merah dengan telur rebus, sayur bayam, dan tempe goreng',
                    'icon' => 'sunrise'
                ],
                'lunch' => [
                    'name' => 'Gado-Gado Sehat',
                    'calories' => 420,
                    'description' => 'Gado-gado dengan tahu, tempe, sayuran rebus, dan bumbu kacang rendah gula',
                    'icon' => 'sun'
                ],
                'dinner' => [
                    'name' => 'Ikan & Sayur Lodeh',
                    'calories' => 400,
                    'description' => 'Ikan pepes dengan sayur lodeh dan nasi merah sedikit',
                    'icon' => 'moon'
                ],
                'snack' => [
                    'name' => 'Pisang & Kacang Hijau',
                    'calories' => 180,
                    'description' => 'Pisang rebus dengan kacang hijau rebus tanpa santan',
                    'icon' => 'coffee'
                ]
            ]
        ];

        // Mapping program recommendation ke meal plan
        $programKey = 'balanced'; // Default

        $programLower = strtolower($programRecommendation);

        if (str_contains($programLower, 'dash')) {
            $programKey = 'dash';
        } elseif (str_contains($programLower, 'mediterania') || str_contains($programLower, 'mediterranean')) {
            $programKey = 'mediterranean';
        } elseif (str_contains($programLower, 'rendah lemak') || str_contains($programLower, 'low fat')) {
            $programKey = 'low_fat';
        } elseif (str_contains($programLower, 'rendah karbohidrat') || str_contains($programLower, 'low carb')) {
            $programKey = 'low_carb';
        } elseif (str_contains($programLower, 'seimbang') || str_contains($programLower, 'balanced')) {
            $programKey = 'balanced';
        }
        return $mealPlans[$programKey];
    }    /**
         * Get food recommendations for user based on their diet recommendations
         */
    private function getFoodRecommendationsForUser($user)
    {
        // Get user's diet recommendations from questionnaire
        $questionnaire = $user->questionnaire;

        if (!$questionnaire || empty($questionnaire->recommended_diets)) {
            return [
                'breakfast' => collect(),
                'lunch' => collect(),
                'dinner' => collect(),
                'snack' => collect(),
            ];
        }

        $dietTypes = $questionnaire->recommended_diets;

        // Ensure $dietTypes is always an array
        if (is_string($dietTypes)) {
            $dietTypes = json_decode($dietTypes, true) ?? [];
        }

        if (!is_array($dietTypes)) {
            $dietTypes = [];
        }

        // Get food recommendations for each meal type
        $mealTypes = ['breakfast', 'lunch', 'dinner', 'snack'];
        $recommendations = [];

        foreach ($mealTypes as $mealType) {
            $recommendations[$mealType] = FoodRecommendation::getRecommendationsForDiets($dietTypes, $mealType)
                ->take(3); // Limit to 3 recommendations per meal type
        }
        return $recommendations;
    }

    /**
     * Get exercise recommendations for user based on their diet recommendations
     */
    private function getExerciseRecommendationsForUser($user)
    {
        // Get user's questionnaire data
        $questionnaire = $user->questionnaire;

        if (!$questionnaire) {
            return collect();
        }

        // Get exercise recommendations based on user's goal and activity level
        $goal = $questionnaire->goal ?? 'Weight loss';
        $activityLevel = $questionnaire->activity_level ?? 'lightly_active';

        // Map questionnaire goals to exercise recommendation goals
        $goalMapping = [
            'lose_weight' => 'Weight loss',
            'gain_weight' => 'Muscle gain',
            'maintain_weight' => 'Maintain weight',
            'improve_fitness' => 'Improve fitness',
        ];

        $mappedGoal = $goalMapping[$goal] ?? $goal;

        return ExerciseRecommendation::active()
            ->forGoal($mappedGoal)
            ->byActivityLevel($activityLevel)
            ->with([
                'exerciseLogs' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            ])
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    }

    /**
     * Add exercise log for user
     */
    public function addExerciseLog(Request $request)
    {
        $request->validate([
            'exercise_recommendation_id' => 'required|exists:exercise_recommendations,id',
            'duration_minutes' => 'required|integer|min:1|max:300',
            'intensity' => 'required|in:low,moderate,high',
            'notes' => 'nullable|string|max:500'
        ]);

        $exerciseRecommendation = ExerciseRecommendation::findOrFail($request->exercise_recommendation_id);        // Calculate estimated calories burned based on duration and intensity
        $baseCalories = $exerciseRecommendation->calories_burned_per_hour ?? 200;

        $intensityMultiplier = match ($request->intensity) {
            'low' => 0.8,
            'moderate' => 1.0,
            'high' => 1.3,
            default => 1.0
        };

        // Convert hourly rate to the actual duration
        $caloriesBurned = round(($baseCalories * $request->duration_minutes / 60) * $intensityMultiplier);

        ExerciseLog::create([
            'user_id' => auth()->id(),
            'exercise_recommendation_id' => $request->exercise_recommendation_id,
            'exercise_name' => $exerciseRecommendation->name,
            'exercise_description' => $exerciseRecommendation->description,
            'duration_minutes' => $request->duration_minutes,
            'calories_burned' => $caloriesBurned,
            'notes' => $request->notes,
            'intensity' => $request->intensity,
            'log_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Olahraga berhasil dicatat!');
    }

    /**
     * Get user's exercise statistics
     */
    private function getUserExerciseStats($user)
    {
        $today = now()->toDateString();
        $thisWeek = now()->startOfWeek();
        $thisMonth = now()->startOfMonth();
        return [
            'today' => [
                'exercises' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', $today)
                    ->count(),
                'duration' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', $today)
                    ->sum('duration_minutes'),
                'calories' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', $today)
                    ->sum('calories_burned'),
            ],
            'thisWeek' => [
                'exercises' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', '>=', $thisWeek)
                    ->count(),
                'duration' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', '>=', $thisWeek)
                    ->sum('duration_minutes'),
            ],
            'thisMonth' => [
                'exercises' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', '>=', $thisMonth)
                    ->count(),
                'duration' => ExerciseLog::where('user_id', $user->id)
                    ->where('log_date', '>=', $thisMonth)
                    ->sum('duration_minutes'),
            ],
            'total' => [
                'exercises' => ExerciseLog::where('user_id', $user->id)->count(),
                'duration' => ExerciseLog::where('user_id', $user->id)->sum('duration_minutes'),
                'calories' => ExerciseLog::where('user_id', $user->id)->sum('calories_burned'),
            ]
        ];
    }

    /**
     * Format weight value with proper precision handling
     */
    private function formatWeight($weight)
    {
        if ($weight === null || $weight === '') {
            return null;
        }

        $formattedWeight = round(floatval($weight), 1);

        // Handle floating point precision issues
        if (abs($formattedWeight) < 0.01) {
            $formattedWeight = 0;
        }

        return $formattedWeight;
    }

    /**
     * Calculate weight change with proper formatting
     */
    private function calculateWeightChange($currentWeight, $previousWeight)
    {
        if (!$currentWeight || !$previousWeight) {
            return 0;
        }

        $change = $currentWeight - $previousWeight;
        $formattedChange = round($change, 1);

        // Handle floating point precision issues
        if (abs($formattedChange) < 0.01) {
            $formattedChange = 0;
        }
        return $formattedChange;
    }

    /**
     * Get exercise recommendation detail for modal
     */
    public function getExerciseDetail($id)
    {
        try {
            $exercise = ExerciseRecommendation::find($id);

            if (!$exercise) {
                return response()->json([
                    'success' => false,
                    'message' => 'Exercise recommendation not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $exercise->id,
                    'name' => $exercise->name,
                    'description' => $exercise->description,
                    'category' => $exercise->category,
                    'category_label' => $exercise->category_label,
                    'goal' => $exercise->goal,
                    'goal_label' => $exercise->goal_label,
                    'calories_burned_per_hour' => $exercise->calories_burned_per_hour,
                    'activity_level' => $exercise->activity_level,
                    'activity_level_label' => $exercise->activity_level_label,
                    'instructions' => $exercise->instructions,
                    'image' => $exercise->image,
                    'display_image' => $exercise->display_image,
                    'video_url' => $exercise->video_url,
                    'is_active' => $exercise->is_active,
                    'created_at' => $exercise->created_at,
                    'updated_at' => $exercise->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching exercise details'
            ], 500);
        }
    }
}