<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function debugMeals()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Not authenticated']);
        }

        $controller = new DashboardController();
        $reflection = new \ReflectionClass($controller);
        
        // Get current day from session or default to today
        $currentDay = session('current_day', 3); // 3 is today (middle of 7 days)
        
        // Generate daily progress
        $generateMethod = $reflection->getMethod('generateDailyProgressWithMeals');
        $generateMethod->setAccessible(true);
        
        $programRecommendation = $user->questionnaire->program_recommendation ?? '';
        $dailyProgress = $generateMethod->invoke($controller, $programRecommendation);
        
        $selectedDay = $dailyProgress[$currentDay] ?? null;
        
        return response()->json([
            'user' => $user->name,
            'goal' => $user->questionnaire->goal ?? 'none',
            'program' => $programRecommendation ?: 'empty',
            'current_day_index' => $currentDay,
            'total_days' => count($dailyProgress),
            'selected_day' => $selectedDay,
            'all_days' => array_map(function($day) {
                return [
                    'date' => $day['full_date'],
                    'day' => $day['day'],
                    'meals_count' => isset($day['meals']) ? count($day['meals']) : 0,
                    'meals' => isset($day['meals']) ? array_keys($day['meals']) : []
                ];
            }, $dailyProgress)
        ]);
    }
}
