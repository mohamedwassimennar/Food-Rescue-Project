<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'comments',
        'feedback_date',
        'association_id',
        'restaurant_id',
    ];

    
    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
