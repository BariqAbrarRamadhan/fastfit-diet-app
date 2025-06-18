<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExerciseRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExerciseRecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ExerciseRecommendation::query();

        // Filter by search
        if ($request->has('search') && $request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by goal
        if ($request->has('goal') && $request->goal) {
            $query->where('goal', $request->goal);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $exercises = $query->latest()->paginate(10);

        $categories = ExerciseRecommendation::getCategories();
        $goals = ExerciseRecommendation::getGoals();

        return view('admin.exercise-recommendations.index', compact(
            'exercises',
            'categories',
            'goals'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ExerciseRecommendation::getCategories();
        $goals = ExerciseRecommendation::getGoals();
        $activityLevels = ExerciseRecommendation::getActivityLevels();

        return view('admin.exercise-recommendations.create', compact(
            'categories',
            'goals',
            'activityLevels'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'goal' => 'required|in:Weight loss,Muscle gain,Maintain weight,Improve fitness',
            'activity_level' => 'required|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
            'image' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:255',
            'instructions' => 'nullable|string',
            'calories_burned_per_hour' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        ExerciseRecommendation::create($data);

        return redirect()->route('admin.exercise-recommendations.index')
            ->with('success', 'Rekomendasi olahraga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExerciseRecommendation $exerciseRecommendation)
    {
        return view('admin.exercise-recommendations.show', compact('exerciseRecommendation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExerciseRecommendation $exerciseRecommendation)
    {
        $categories = ExerciseRecommendation::getCategories();
        $goals = ExerciseRecommendation::getGoals();
        $activityLevels = ExerciseRecommendation::getActivityLevels();

        return view('admin.exercise-recommendations.edit', compact(
            'exerciseRecommendation',
            'categories',
            'goals',
            'activityLevels'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExerciseRecommendation $exerciseRecommendation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'goal' => 'required|in:Weight loss,Muscle gain,Maintain weight,Improve fitness',
            'activity_level' => 'required|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
            'image' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:255',
            'instructions' => 'nullable|string',
            'calories_burned_per_hour' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        $exerciseRecommendation->update($data);

        return redirect()->route('admin.exercise-recommendations.index')
            ->with('success', 'Rekomendasi olahraga berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExerciseRecommendation $exerciseRecommendation)
    {
        $exerciseRecommendation->delete();

        return redirect()->route('admin.exercise-recommendations.index')
            ->with('success', 'Rekomendasi olahraga berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(ExerciseRecommendation $exerciseRecommendation)
    {
        $exerciseRecommendation->update([
            'is_active' => !$exerciseRecommendation->is_active
        ]);

        $status = $exerciseRecommendation->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Rekomendasi olahraga berhasil {$status}!");
    }
}
