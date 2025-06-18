<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise_recommendation_id',
        'exercise_name',
        'exercise_description',
        'duration_minutes',
        'intensity',
        'calories_burned',
        'notes',
        'log_date'
    ];

    protected $casts = [
        'log_date' => 'date'
    ];

    /**
     * Boot the model and set up event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Ensure exercise_name is always populated when creating
        static::creating(function ($exerciseLog) {
            if (empty($exerciseLog->exercise_name) && $exerciseLog->exercise_recommendation_id) {
                $recommendation = ExerciseRecommendation::find($exerciseLog->exercise_recommendation_id);
                if ($recommendation) {
                    $exerciseLog->exercise_name = $recommendation->name;
                    $exerciseLog->exercise_description = $exerciseLog->exercise_description ?: $recommendation->description;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseRecommendation()
    {
        return $this->belongsTo(ExerciseRecommendation::class);
    }
}
