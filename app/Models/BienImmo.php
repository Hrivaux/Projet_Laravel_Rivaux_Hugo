<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienImmo extends Model
{
    use HasFactory;

    protected $table = 'bien_immo';

    // Relation avec la table photo_bien
    public function photos()
    {
        return $this->hasMany(PhotoBien::class, 'id_bien');
    }

    // Relation avec les utilisateurs favoris
    public function utilisateursFavoris()
    {
        return $this->belongsToMany(User::class, 'favoris', 'bien_immo_id', 'user_id')->withTimestamps();
    }
}
