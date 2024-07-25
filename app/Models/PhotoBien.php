<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoBien extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bien',
        'image',
    ];
    public $timestamps = false; // Désactiver les timestamps automatiques

    protected $table = 'photo_bien'; // Spécifiez explicitement le nom de la table
}
