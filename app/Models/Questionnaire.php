<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal',
        'gender',
        'age',
        'height',
        'weight',
        'target_weight',
        'activity_level',
        'weekly_exercise',
        'is_heart_disease',
        'is_hypertension',
        'is_dyslipidemia',
        'recommended_diets',
        'program_recommendation',
    ];

    protected $casts = [
        'is_heart_disease' => 'boolean',
        'is_hypertension' => 'boolean',
        'is_dyslipidemia' => 'boolean',
        'recommended_diets' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}