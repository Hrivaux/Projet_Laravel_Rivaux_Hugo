<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $table = 'bien_immo'; // Nom de la table dans votre base de données

    protected $fillable = [
        'libelle', 'prix', 'etat', 'description', 'adresse', 'ville', 'code_postal'
        // Ajoutez d'autres colonnes de votre table Annonce ici si nécessaire
    ];

    // Relation avec les photos de l'annonce (assumant une relation One-to-Many)
    public function photos()
    {
        return $this->hasMany(PhotoBien::class, 'id_bien', 'id');
    }
}
