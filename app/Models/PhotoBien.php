<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoBien extends Model
{
    use HasFactory;

    protected $table = 'photo_bien';

    // Relation inverse avec la table bien_immo
    public function bienImmo()
    {
        return $this->belongsTo(BienImmo::class, 'id_bien');
    }
}
