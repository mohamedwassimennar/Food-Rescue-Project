<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes'; // Nom de la table dans la base de données

    protected $fillable = [
        'association_id', 
        'produit', 
        'quantite', 
        'date_collecte', 
        'etat'
    ];

    // Une demande appartient à une association
    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    // Une demande appartient à un partenaire (restaurant ou commerçant)
    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class); // Associe la demande à l'utilisateur
    }
}
