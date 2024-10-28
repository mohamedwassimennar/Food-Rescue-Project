<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'image',
        'expired_date',
        'calories',
        'fats',
        'carbs',
        'proteins',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public static function totalFoodItems()
    {
        return self::count();
    }

    public static function averageCalories()
    {
        return self::avg('calories');
    }

}
