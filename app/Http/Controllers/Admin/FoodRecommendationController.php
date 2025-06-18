<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodRecommendationController extends Controller
{
    protected $dietTypes = [
        'Low Fat' => 'Diet Rendah Lemak',
        'Low Carb' => 'Diet Rendah Karbohidrat',
        'Balanced Diet' => 'Diet Seimbang',
        'Mediterranean' => 'Diet Mediterania',
        'DASH' => 'Diet DASH',
    ];

    protected $mealTypes = [
        'breakfast' => 'Sarapan',
        'lunch' => 'Makan Siang',
        'dinner' => 'Makan Malam',
        'snack' => 'Camilan',
    ];

    protected $dayTypes = [
        'monday' => 'Senin',
        'tuesday' => 'Selasa',
        'wednesday' => 'Rabu',
        'thursday' => 'Kamis',
        'friday' => 'Jumat',
        'saturday' => 'Sabtu',
        'sunday' => 'Minggu',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FoodRecommendation::query();

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan tipe diet
        if ($request->has('diet_type') && !empty($request->diet_type)) {
            $query->forDietType($request->diet_type);
        }

        // Filter berdasarkan tipe makanan
        if ($request->has('meal_type') && !empty($request->meal_type)) {
            $query->forMealType($request->meal_type);
        }

        // Filter berdasarkan hari
        if ($request->has('day') && !empty($request->day)) {
            $query->forDay($request->day);
        }

        // Filter berdasarkan status
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $foodRecommendations = $query->latest()->paginate(10);

        return view('admin.food-recommendations.index', [
            'foodRecommendations' => $foodRecommendations,
            'dietTypes' => $this->dietTypes,
            'mealTypes' => $this->mealTypes,
            'dayTypes' => $this->dayTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.food-recommendations.create', [
            'dietTypes' => $this->dietTypes,
            'mealTypes' => $this->mealTypes,
            'dayTypes' => $this->dayTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'diet_types' => 'required|array',
            'diet_types.*' => 'string',
            'meal_type' => 'required|string|in:breakfast,lunch,dinner,snack',
            'day' => 'nullable|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'calories_per_serving' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('food-recommendations', 'public');
            $data['image'] = $imagePath;
        }

        FoodRecommendation::create($data);

        return redirect()->route('admin.food-recommendations.index')
            ->with('success', 'Rekomendasi makanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodRecommendation $foodRecommendation)
    {
        return view('admin.food-recommendations.show', compact('foodRecommendation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodRecommendation $foodRecommendation)
    {
        return view('admin.food-recommendations.edit', [
            'foodRecommendation' => $foodRecommendation,
            'dietTypes' => $this->dietTypes,
            'mealTypes' => $this->mealTypes,
            'dayTypes' => $this->dayTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodRecommendation $foodRecommendation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'diet_types' => 'required|array',
            'diet_types.*' => 'string',
            'meal_type' => 'required|string|in:breakfast,lunch,dinner,snack',
            'day' => 'nullable|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'calories_per_serving' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($foodRecommendation->image) {
                Storage::disk('public')->delete($foodRecommendation->image);
            }

            $imagePath = $request->file('image')->store('food-recommendations', 'public');
            $data['image'] = $imagePath;
        }

        $foodRecommendation->update($data);

        return redirect()->route('admin.food-recommendations.index')
            ->with('success', 'Rekomendasi makanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodRecommendation $foodRecommendation)
    {
        // Delete image if exists
        if ($foodRecommendation->image) {
            Storage::disk('public')->delete($foodRecommendation->image);
        }

        $foodRecommendation->delete();

        return redirect()->route('admin.food-recommendations.index')
            ->with('success', 'Rekomendasi makanan berhasil dihapus!');
    }
}
