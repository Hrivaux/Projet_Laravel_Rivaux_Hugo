<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\MonCompteController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\BienImmoController;
use App\Http\Controllers\DeposerBienController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/favoris/ajouter/{bienImmoId}', [FavorisController::class, 'ajouter'])->name('favoris.ajouter');
Route::post('/favoris/supprimer/{bienImmoId}', [FavorisController::class, 'supprimer'])->name('favoris.supprimer');

Route::get('/moncompte', 'App\Http\Controllers\MonCompteController@index')->name('moncompte');

Route::put('/moncompte/{id}', [MonCompteController::class, 'update'])->name('moncompte.update');

Route::get('/annonce/{id}', [AnnonceController::class, 'show'])->name('annonce.show');

Route::get('/deposer-bien', [DeposerBienController::class, 'index'])->name('deposer_bien');

// Route pour traiter le formulaire de dépôt
Route::post('/deposer-bien', [DeposerBienController::class, 'store'])->name('deposer_bien.store');









