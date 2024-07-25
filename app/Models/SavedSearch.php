<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    // Propriétés que vous pouvez remplir
    protected $fillable = ['user_id', 'name', 'search_criteria'];

    // Convertir le champ 'search_criteria' en tableau PHP automatiquement
    protected $casts = [
        'search_criteria' => 'array',
    ];

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
