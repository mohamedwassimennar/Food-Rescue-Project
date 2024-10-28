<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contact',
        'cuisine_type',
        'total_food',
        'donation_history',
        'user_id',
        'opening_time',
        'closing_time',
        'status',
    ];

    protected $casts = [
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    public function food()
    {
        return $this->hasMany(Food::class);
    }

    public function donation()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setOpeningHoursAttribute($value)
    {
        $this->attributes['opening_hours'] = json_encode($value);
    }

    public function getOpeningHoursAttribute($value)
    {
        return json_decode($value, true);
    }
    public function consignes()
    {
        return $this->hasMany(Consigne::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(FeedBack::class);
    }

    public static function totalRestaurants()
    {
        return self::count();
    }

}
