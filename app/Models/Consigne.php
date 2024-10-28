<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consigne extends Model
{
    use HasFactory;
    protected $fillable = [
        'expediteur',
        'destinataire',
        'contenu',
        'date_envoi',
        'statut',
        'restaurant_id',
        'association_id',
    ];

   
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }
}
