<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    // Propriétés que vous pouvez remplir
    protected $fillable = ['user_id', 'name', 'search_criteria'];

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
