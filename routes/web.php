<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\MonCompteController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\DeposerBienController;
use App\Http\Controllers\SavedSearchController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestEmailController;
// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentification
Auth::routes();
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    // Favoris
    Route::post('/favoris/ajouter/{bienImmoId}', [FavorisController::class, 'ajouter'])->name('favoris.ajouter');
    Route::post('/favoris/supprimer/{bienImmoId}', [FavorisController::class, 'supprimer'])->name('favoris.supprimer');

    // Mon Compte
    Route::get('/moncompte', [MonCompteController::class, 'index'])->name('moncompte');
    Route::put('/moncompte/{id}', [MonCompteController::class, 'update'])->name('moncompte.update');
    Route::post('/moncompte/save-search', [MonCompteController::class, 'saveSearch'])->name('save-search');
    Route::delete('/moncompte/delete-search/{id}', [MonCompteController::class, 'deleteSearch'])->name('delete-search');

    // Annonces
    Route::get('/annonces/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('/annonces/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
    Route::get('/annonce/{id}', [AnnonceController::class, 'show'])->name('annonce.show');
    Route::get('/annonces/search', [AnnonceController::class, 'search'])->name('annonces.search');
    Route::resource('annonces', AnnonceController::class);

    // Déposer un bien
    Route::get('/deposer-bien', [DeposerBienController::class, 'index'])->name('deposer_bien');
    Route::post('/deposer-bien', [DeposerBienController::class, 'store'])->name('deposer_bien.store');

    // Recherches Sauvegardées
    Route::post('/saved-searches', [SavedSearchController::class, 'store'])->name('saved-searches.store');
    Route::get('/saved-searches', [SavedSearchController::class, 'index'])->name('saved-searches.index');
    Route::get('/saved-searches/apply/{id}', [SavedSearchController::class, 'apply'])->name('saved-searches.apply');
    Route::delete('/saved-searches/{id}', [SavedSearchController::class, 'destroy'])->name('saved-searches.destroy');
    Route::get('/saved-searches/edit/{id}', [SavedSearchController::class, 'edit'])->name('saved-searches.edit');
Route::put('/saved-searches/{id}', [SavedSearchController::class, 'update'])->name('saved-searches.update');
});

// Contact

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// Pages statiques accessibles sans connexion

Route::get('/qui-sommes-nous', [PageController::class, 'about'])->name('qui_sommes_nous');


Route::get('/send-test-email', [TestEmailController::class, 'sendTestEmail']);
