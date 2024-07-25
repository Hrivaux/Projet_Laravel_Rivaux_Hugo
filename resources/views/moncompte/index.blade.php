@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Section Profil Utilisateur -->
    <div class="mb-4">
        <h1 class="mb-3">{{ Auth::user()->name }}</h1>
    </div>

    <!-- Section Mes annonces Favorites -->
    <div class="mb-4 p-3 border rounded shadow">
        <h2>Mes annonces Favorites</h2>
        
        @if ($favoris->count() > 0)
            <div class="row">
                @foreach ($favoris as $favori)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border rounded shadow">
                            @if ($favori->photos->isNotEmpty())
                                <img src="{{ asset('storage/images/' . $favori->photos->first()->image) }}" class="card-img-top rounded-top" style="height: 200px;" alt="{{ $favori->libelle }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top rounded-top" style="height: 200px;" alt="{{ $favori->libelle }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $favori->libelle }}</h5>
                                <p class="card-text">Prix : {{ number_format($favori->prix, 2, ',', ' ') }} €</p>
                                <p class="card-text">État : {{ $favori->etat }}</p>
                                <!-- Ajoutez d'autres informations de l'annonce si nécessaire -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Vous n'avez pas encore d'annonces favorites.</p>
        @endif
    </div>

    <!-- Section Mes recherches sauvegardées -->
    <div class="mb-4 p-3 border rounded shadow">
        <h2>Mes recherches sauvegardées</h2>

        @if ($savedSearches->count() > 0)
            <div class="list-group">
                @foreach ($savedSearches as $search)
                    <div class="list-group-item d-flex justify-content-between align-items-center border rounded shadow">
                        {{ $search->name }}

                        <div class="d-flex">
                            <!-- Bouton Appliquer -->
                            <a href="{{ route('saved-searches.apply', $search->id) }}" class="btn btn-primary btn-sm me-2">Appliquer</a>

                            <!-- Formulaire pour supprimer la recherche sauvegardée -->
                            <form action="{{ route('saved-searches.destroy', $search->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recherche sauvegardée ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Vous n'avez pas encore de recherches sauvegardées.</p>
        @endif
    </div>
    
    <!-- Informations personnelles de l'utilisateur -->
    <div class="mb-4 p-3 border rounded shadow">
        <h2>Mes informations personnelles</h2>

        <form action="{{ route('moncompte.update', Auth::user()->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="{{ $user->ville }}" required>
            </div>

            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $user->adresse }}" required>
            </div>

            <div class="mb-3">
                <label for="code_postal" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ $user->code_postal }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Laissez ce champ vide si vous ne souhaitez pas modifier le mot de passe.</small>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

    <!-- Section Mes annonces déposées -->
<div class="mb-4 p-3 border rounded shadow">
    <h2>Mes annonces déposées</h2>

    @if ($annoncesDeposees->count() > 0)
        <div class="row">
            @foreach ($annoncesDeposees as $annonce)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border rounded shadow">
                        @if($annonce->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $annonce->photos->first()->image) }}" class="card-img-top rounded-top" style="height: 200px;" alt="{{ $annonce->libelle }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top rounded-top" style="height: 200px;" alt="{{ $annonce->libelle }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $annonce->libelle }}</h5>
                            <p class="card-text">Prix : {{ number_format($annonce->prix, 2, ',', ' ') }} €</p>
                            <p class="card-text">État : {{ $annonce->etat }}</p>

                            <!-- Boutons pour Modifier et Supprimer -->
                            <div class="d-flex justify-content-between mt-3">
                                <!-- Bouton Détails -->
                                <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-info btn-sm">Détails</a>

                                <!-- Bouton Modifier -->
                                <a href="{{ route('annonces.edit', $annonce->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                                <!-- Formulaire pour Supprimer -->
                                <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Vous n'avez pas encore déposé d'annonces.</p>
    @endif
</div>

</div>
@endsection
