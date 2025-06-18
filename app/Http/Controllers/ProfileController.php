<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\ExerciseRecommendation;
use App\Models\WeightLog;
use App\Models\WaterLog;
use App\Models\MealLog;
use App\Models\ExerciseLog;
use App\Models\Questionnaire;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $activeTab = $request->query('tab', Session::get('profile_tab', 'profile'));
        Session::put('profile_tab', $activeTab);
        $userModel = Auth::user();
        $questionnaire = $userModel->questionnaire;
        $questionnaireWeight = $questionnaire ? $questionnaire->weight : null;

        // Berat badan & tinggi dari questionnaire/log terakhir
        $weightLogs = WeightLog::where('user_id', $userModel->id)->orderBy('log_date', 'asc')->get();
        $latestWeightLog = $weightLogs->last();
        $latestWeight = $latestWeightLog ? $latestWeightLog->weight : $questionnaireWeight;
        $initialWeight = $weightLogs->first();
        $targetWeight = $questionnaire->target_weight ?? null;
        $height = $questionnaire->height ?? null;

        // Calculate BMI - handle both WeightLog object and float value
        $bmi = null;
        if ($latestWeight && $height) {
            $weightValue = is_object($latestWeight) ? $latestWeight->weight : $latestWeight;
            $bmi = round($weightValue / pow($height / 100, 2), 1);
        }// Water intake
        $waterLogs = WaterLog::where('user_id', $userModel->id)
            ->whereBetween('log_date', [now()->subDays(6)->toDateString(), now()->toDateString()])
            ->get();
        $waterHistory = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $amount = $waterLogs->where('log_date', $date)->sum('volume');
            $waterHistory[] = ['date' => $date, 'amount' => $amount];
        }
        $todayWater = $waterHistory[6]['amount'] ?? 0;
        $waterGoal = 2500;        // Calculate nutrition recommendations based on user data
        $nutritionRecommendations = $this->calculateNutritionRecommendations($questionnaire, $latestWeight);        // Get detailed exercise recommendations
        $detailedExerciseRecommendations = ExerciseRecommendation::where('is_active', true)
            ->limit(6)
            ->get();        // Get meal history for tracking
        $mealHistory = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $calories = MealLog::where('user_id', $userModel->id)
                ->whereDate('log_date', $date)
                ->sum('calories');
            $mealHistory[] = ['date' => $date, 'calories' => $calories];
        }        // Get exercise history for tracking
        $exerciseHistory = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $duration = ExerciseLog::where('user_id', $userModel->id)
                ->whereDate('log_date', $date)
                ->sum('duration_minutes');
            $calories = ExerciseLog::where('user_id', $userModel->id)
                ->whereDate('log_date', $date)
                ->sum('calories_burned');
            $exerciseHistory[] = ['date' => $date, 'duration' => $duration, 'calories' => $calories];
        }// Apply date filter for progress tab
        $filterDays = $request->query('filter', 7);
        if (!in_array($filterDays, [7, 14, 30, 90])) {
            $filterDays = 7;
        }

        // Get filtered weight data based on filterDays
        $filteredWeightLogs = WeightLog::where('user_id', $userModel->id)
            ->whereBetween('log_date', [now()->subDays($filterDays - 1)->toDateString(), now()->toDateString()])
            ->orderBy('log_date', 'asc')
            ->get();

        // Create weight history array for the filtered period
        $filteredWeightHistory = [];
        for ($i = $filterDays - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $weightLog = $filteredWeightLogs->where('log_date', $date)->first();
            $filteredWeightHistory[] = [
                'date' => $date,
                'weight' => $weightLog ? $weightLog->weight : null
            ];
        }        // Get filtered meal history based on filterDays
        $filteredMealHistory = [];
        for ($i = $filterDays - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $calories = MealLog::where('user_id', $userModel->id)
                ->whereDate('log_date', $date)
                ->sum('calories');
            $filteredMealHistory[] = ['date' => $date, 'calories' => $calories];
        }        // Get filtered exercise history based on filterDays
        $filteredExerciseHistory = [];
        for ($i = $filterDays - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $duration = ExerciseLog::where('user_id', $userModel->id)
                ->whereDate('log_date', $date)
                ->sum('duration_minutes');
            $calories = ExerciseLog::where('user_id', $userModel->id)
                ->whereDate('log_date', $date)
                ->sum('calories_burned');
            $filteredExerciseHistory[] = ['date' => $date, 'duration' => $duration, 'calories' => $calories];
        }

        // Get filtered water history based on filterDays
        $filteredWaterLogs = WaterLog::where('user_id', $userModel->id)
            ->whereBetween('log_date', [now()->subDays($filterDays - 1)->toDateString(), now()->toDateString()])
            ->get();
        $filteredWaterHistory = [];
        for ($i = $filterDays - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $amount = $filteredWaterLogs->where('log_date', $date)->sum('volume');
            $filteredWaterHistory[] = ['date' => $date, 'amount' => $amount];
        }

        // Stats
        $user = [
            'name' => $userModel->name,
            'email' => $userModel->email,
            'image' => $userModel->image ?? asset('images/placeholder.svg'),
            'stats' => [
                'weight' => $latestWeight ? (is_object($latestWeight) ? $latestWeight->weight : $latestWeight) . 'kg' : '-',
                'height' => $height ? $height . 'cm' : '-',
                'bmi' => $bmi ?? '-',
                'goal' => $questionnaire->goal ?? '-',
            ],
            'waterIntake' => [
                'current' => $todayWater,
                'goal' => $waterGoal,
                'history' => $filteredWaterHistory,
            ],
            'programRecommendation' => $questionnaire->program_recommendation ?? '-',
            'exerciseRecommendation' => 'Kardio (30 menit, 3x seminggu) & Latihan Kekuatan (2x seminggu)',
            'detailedExerciseRecommendations' => $detailedExerciseRecommendations,
            'nutritionRecommendations' => $nutritionRecommendations,
            'weightHistory' => $filteredWeightHistory,
            'mealHistory' => $filteredMealHistory,
            'exerciseHistory' => $filteredExerciseHistory,
            'filterDays' => $filterDays,
            'dateFilter' => match ($filterDays) {
                7 => '7_days',
                14 => '14_days',
                30 => '30_days',
                90 => '90_days',
                default => '7_days'
            },
            'weightStats' => [
                'initial' => $initialWeight ? $initialWeight->weight : '-',
                'current' => $latestWeight ? (is_object($latestWeight) ? $latestWeight->weight : $latestWeight) : '-',
                'target' => $targetWeight ?? '-',
                'change' => ($latestWeight && $initialWeight) ? round((is_object($latestWeight) ? $latestWeight->weight : $latestWeight) - $initialWeight->weight, 1) : 0,
                'changePercentage' => ($latestWeight && $initialWeight && $initialWeight->weight > 0) ? round(((is_object($latestWeight) ? $latestWeight->weight : $latestWeight) - $initialWeight->weight) / $initialWeight->weight * 100, 1) : 0,
            ],
        ];

        return view('profile', compact('user', 'activeTab'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'weight' => 'nullable|numeric|min:30|max:200',
            'height' => 'nullable|numeric|min:100|max:250',
            'age' => 'nullable|numeric|min:10|max:120',
            'gender' => 'nullable|in:male,female,other',
            'goal' => 'nullable|string',
            'target_weight' => 'nullable|numeric|min:30|max:200',
            'activity_level' => 'nullable|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
            'weekly_exercise' => 'nullable|numeric|min:0|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Update user basic info
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update or create questionnaire data
        $questionnaireData = [
            'goal' => $request->goal,
            'gender' => $request->gender,
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
            'target_weight' => $request->target_weight,
            'activity_level' => $request->activity_level,
        ];

        // Remove null values
        $questionnaireData = array_filter($questionnaireData, function ($value) {
            return $value !== null;
        });
        if (!empty($questionnaireData)) {
            Questionnaire::updateOrCreate(
                ['user_id' => $user->id],
                $questionnaireData
            );
        }

        // If weight is updated, create a new weight log entry
        if ($request->weight) {
            WeightLog::create([
                'user_id' => $user->id,
                'weight' => $request->weight,
                'log_date' => now()->toDateString(),
            ]);
        }

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function calculateNutritionRecommendations($questionnaire, $latestWeight)
    {
        if (!$questionnaire || !$latestWeight) {
            return [
                'calories' => '1,800 - 2,000',
                'protein' => ['grams' => '100 - 120', 'percentage' => '25%'],
                'carbs' => ['grams' => '180 - 220', 'percentage' => '45%'],
                'fats' => ['grams' => '50 - 65', 'percentage' => '30%'],
            ];
        }        // Calculate BMR (Basal Metabolic Rate) using Mifflin-St Jeor Equation
        $weight = is_object($latestWeight) ? $latestWeight->weight : $latestWeight;
        $height = $questionnaire->height ?? 165;
        $age = $questionnaire->age ?? 25;
        $gender = $questionnaire->gender ?? 'female';

        if ($gender === 'male') {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        // Activity level multipliers
        $activityMultipliers = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extra_active' => 1.9,
        ];

        $activityLevel = $questionnaire->activity_level ?? 'lightly_active';
        $tdee = $bmr * ($activityMultipliers[$activityLevel] ?? 1.375);

        // Adjust for goal
        $goal = $questionnaire->goal ?? 'Weight loss';
        if ($goal === 'Weight loss') {
            $dailyCalories = $tdee - 500; // 500 calorie deficit for 1lb/week loss
        } elseif ($goal === 'Muscle gain') {
            $dailyCalories = $tdee + 300; // 300 calorie surplus
        } else {
            $dailyCalories = $tdee; // Maintenance
        }

        // Calculate macronutrients
        $protein = ($dailyCalories * 0.25) / 4; // 25% calories from protein (4 cal/g)
        $carbs = ($dailyCalories * 0.45) / 4; // 45% calories from carbs (4 cal/g)
        $fats = ($dailyCalories * 0.30) / 9; // 30% calories from fats (9 cal/g)

        return [
            'calories' => number_format($dailyCalories, 0),
            'protein' => [
                'grams' => number_format($protein, 0),
                'percentage' => '25%'
            ],
            'carbs' => [
                'grams' => number_format($carbs, 0),
                'percentage' => '45%'
            ],
            'fats' => [
                'grams' => number_format($fats, 0),
                'percentage' => '30%'
            ],
        ];
    }
}