<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'food',
        'expiration_date',
        'quantity',
        'location',
        'category_id', // Add the foreign key here

    ];
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
