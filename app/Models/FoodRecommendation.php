<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'diet_types',
        'meal_type',
        'day',
        'calories_per_serving',
        'is_active',
    ];

    protected $casts = [
        'diet_types' => 'array',
        'is_active' => 'boolean',
        'calories_per_serving' => 'integer',
    ];

    // Scope untuk makanan aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk makanan berdasarkan tipe diet
    public function scopeForDietType($query, $dietType)
    {
        return $query->whereJsonContains('diet_types', $dietType);
    }

    // Scope untuk makanan berdasarkan tipe makanan
    public function scopeForMealType($query, $mealType)
    {
        return $query->where('meal_type', $mealType);
    }

    // Scope untuk makanan berdasarkan hari
    public function scopeForDay($query, $day)
    {
        return $query->where('day', $day);
    }

    // Helper untuk mendapatkan makanan berdasarkan rekomendasi diet
    public static function getRecommendationsForDiets($dietTypes, $mealType = null)
    {
        $query = static::active();

        // Ensure $dietTypes is an array
        if (is_string($dietTypes)) {
            $dietTypes = json_decode($dietTypes, true) ?? [];
        }

        if (!is_array($dietTypes)) {
            $dietTypes = [];
        }

        // Filter berdasarkan tipe diet
        if (!empty($dietTypes)) {
            $query->where(function ($q) use ($dietTypes) {
                foreach ($dietTypes as $diet) {
                    $q->orWhereJsonContains('diet_types', $diet);
                }
            });
        }

        // Filter berdasarkan tipe makanan jika diberikan
        if ($mealType) {
            $query->forMealType($mealType);
        }

        return $query->get();
    }
}
