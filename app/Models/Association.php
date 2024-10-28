<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $table = 'associations'; // Cette ligne est optionnelle si le nom de la table est déjà au pluriel.

    protected $fillable = [
        'nom', 
    ];

    /**
     * Get the demandes for the association.
     */
    public function demandes()
    {
        return $this->hasMany(Demande::class); // Assurez-vous que le modèle Demande existe et est correctement défini
    }

    public function consignes()
    {
        return $this->hasMany(Consigne::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(FeedBack::class);
    }

  
}

