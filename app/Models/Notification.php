<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Nom de la table si différent du nom par défaut
    protected $table = 'notifications';

    // Attributs modifiables
    protected $fillable = [
        'type',
        'date_heure',
        'statut',
        'message',
        'evenement_collecte_id', // Clé étrangère vers EvenementCollecte
    ];

    // Relation avec ÉvénementCollecte (N-1)
    public function evenementCollecte()
    {
        return $this->belongsTo(EvenementCollecte::class);
    }
}
