<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'menu_id', 'promo_id', 'user_id', 'quantity', 'total_price'];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}