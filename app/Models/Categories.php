<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'type',
        'description',
    ];

    // Define the relationship
    public function stocks()
    {
        return $this->hasMany(Stocks::class);
    }
}
