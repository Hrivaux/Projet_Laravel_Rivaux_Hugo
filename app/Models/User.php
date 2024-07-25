<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\BienImmo;
use App\Models\SavedSearch; // Assurez-vous d'importer le modèle SavedSearch

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the favoris for the user.
     */
    public function favoris()
    {
        return $this->belongsToMany(BienImmo::class, 'favoris', 'user_id', 'bien_immo_id')->withTimestamps();
    }

    /**
     * Get the saved searches for the user.
     */
    public function savedSearches()
    {
        return $this->hasMany(SavedSearch::class);
    }
}
