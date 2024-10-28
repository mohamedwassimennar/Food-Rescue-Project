<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nama_menu', 'kategori_menu', 'gambar_menu', 'harga_menu', ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}