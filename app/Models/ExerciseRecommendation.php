<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'goal',
        'image',
        'video_url',
        'activity_level',
        'instructions',
        'calories_burned_per_hour',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForGoal($query, $goal)
    {
        return $query->where('goal', $goal);
    }

    public function scopeByActivityLevel($query, $activityLevel)
    {
        return $query->where('activity_level', $activityLevel);
    }

    public function exerciseLogs()
    {
        return $this->hasMany(ExerciseLog::class);
    }

    // Accessor methods for labels
    public function getCategoryLabelAttribute()
    {
        $categories = self::getCategories();
        return $categories[$this->category] ?? $this->category;
    }

    public function getGoalLabelAttribute()
    {
        $goals = self::getGoals();
        return $goals[$this->goal] ?? $this->goal;
    }

    public function getActivityLevelLabelAttribute()
    {
        $levels = self::getActivityLevels();
        return $levels[$this->activity_level] ?? $this->activity_level;
    }

    public static function getCategories()
    {
        return [
            'cardio' => 'Kardio',
            'strength' => 'Kekuatan',
            'flexibility' => 'Fleksibilitas',
            'balance' => 'Keseimbangan',
            'yoga' => 'Yoga',
            'pilates' => 'Pilates',
            'hiit' => 'HIIT',
            'mixed' => 'Campuran',
        ];
    }

    public static function getGoals()
    {
        return [
            'weight_loss' => 'Penurunan Berat Badan',
            'muscle_gain' => 'Meningkatkan Massa Otot',
            'maintain_weight' => 'Menjaga Berat Badan',
        ];
    }

    public static function getActivityLevels()
    {
        return [
            'sedentary' => 'Sangat Rendah',
            'moderately_active' => 'Sedang',
            'extra_active' => 'Ekstra Tinggi',
        ];
    }

    // Method to get the main display image
    public function getDisplayImageAttribute()
    {
        return $this->image ?: asset('images/default-exercise.jpg');
    }
}
