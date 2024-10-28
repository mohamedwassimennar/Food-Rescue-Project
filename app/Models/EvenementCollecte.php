<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementCollecte extends Model
{
    use HasFactory;

    // Nom de la table si différent du nom par défaut
    protected $table = 'evenement_collectes';

    // Attributs modifiables
    protected $fillable = [
        'nom',
        'date',
        'lieu',
        'type_nourriture',
        'organisateur'
    ];

    // Relation avec Notification (1-N)
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
