<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification (login, logout, etc.)
Auth::routes();

// Page d'accueil après connexion
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route de déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
