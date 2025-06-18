<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meal_type',
        'meal_name',
        'calories',
        'description',
        'log_date',
    ];

    protected $casts = [
        'log_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
