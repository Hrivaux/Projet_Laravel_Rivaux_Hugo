@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Formulaire de recherche avancée -->
    <div class="mb-4 p-4 border rounded shadow-sm bg-light">
        <h3 class="mb-4">Recherche Avancée</h3>
        <form method="GET" action="{{ route('annonces.search') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="{{ request('ville') }}">
                </div>
                <div class="col-md-4">
                    <label for="prix_min" class="form-label">Prix Min</label>
                    <input type="number" class="form-control" name="prix_min" id="prix_min" placeholder="Prix minimum" value="{{ request('prix_min') }}">
                </div>
                <div class="col-md-4">
                    <label for="prix_max" class="form-label">Prix Max</label>
                    <input type="number" class="form-control" name="prix_max" id="prix_max" placeholder="Prix maximum" value="{{ request('prix_max') }}">
                </div>
                <div class="col-md-4">
                    <label for="superficie_min" class="form-label">Superficie Min</label>
                    <input type="number" class="form-control" name="superficie_min" id="superficie_min" placeholder="Superficie minimum (m²)" value="{{ request('superficie_min') }}">
                </div>
                <div class="col-md-4">
                    <label for="superficie_max" class="form-label">Superficie Max</label>
                    <input type="number" class="form-control" name="superficie_max" id="superficie_max" placeholder="Superficie maximum (m²)" value="{{ request('superficie_max') }}">
                </div>
                <div class="col-md-4">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" name="type" id="type">
                        <option value="">-- Sélectionnez --</option>
                        <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                        <option value="maison" {{ request('type') == 'maison' ? 'selected' : '' }}>Maison</option>
                        <!-- Ajoutez d'autres options si nécessaire -->
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ordre" class="form-label">Ordre</label>
                    <select class="form-select" name="ordre" id="ordre">
                        <option value="prix_asc" {{ request('ordre') == 'prix_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="prix_desc" {{ request('ordre') == 'prix_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        <!-- Ajoutez d'autres options de tri si nécessaire -->
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                    <!-- Bouton pour vider la recherche -->
                    <button type="button" class="btn btn-secondary ms-2" onclick="resetForm()">Vider la recherche</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function resetForm() {
            // Trouver le formulaire et réinitialiser tous ses champs
            document.querySelector('form').reset();
            // Optionnel : soumettre le formulaire pour vider les paramètres de recherche
            window.location.href = "{{ route('annonces.search') }}";
        }
    </script>

    <!-- Formulaire pour sauvegarder la recherche -->
    @if(isset($annonces))
    <div class="mb-4 p-4 border rounded shadow-sm bg-light">
        <h4 class="mb-3">Sauvegarder la Recherche</h4>
        <form method="POST" action="{{ route('saved-searches.store') }}">
            @csrf
            <input type="hidden" name="search_params" value="{{ json_encode(request()->except('_token')) }}">
            <div class="row g-3">
                <div class="col-md-9">
                    <input type="text" class="form-control" name="name" placeholder="Nom de la recherche" required>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary w-100" type="submit">Sauvegarder</button>
                </div>
            </div>
        </form>
    </div>
    @endif

    <!-- Affichage des recherches sauvegardées -->
@if(Auth::check())
    <div class="mt-4">
        <h4>Recherches Sauvegardées</h4>
        @if($savedSearches->isEmpty())
            <p>Aucune recherche sauvegardée.</p>
        @else
            <ul class="list-group">
                @foreach($savedSearches as $search)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $search->name }}

                        <div class="d-flex">
                            <!-- Bouton Appliquer -->
                            <a href="{{ route('saved-searches.apply', $search->id) }}" class="btn btn-primary btn-sm me-2">
                                Appliquer
                            </a>

                            <!-- Formulaire pour supprimer la recherche sauvegardée -->
                            <form action="{{ route('saved-searches.destroy', $search->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recherche sauvegardée ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endif


    <br><br>
    <!-- Affichage des annonces -->
    @if(isset($annonces))
        @if($annonces->isEmpty())
            <p>Aucune annonce disponible pour le moment.</p>
        @else
            <div class="row">
                @foreach($annonces as $annonce)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($annonce->photos->isNotEmpty())
                                <img src="{{ asset('storage/' . $annonce->photos->first()->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $annonce->libelle }}">
                            @else
                                <img src="https://via.placeholder.com/350x200" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $annonce->libelle }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $annonce->libelle }}</h5>
                                <p class="card-text"><strong>Prix :</strong> {{ number_format($annonce->prix, 2, ',', ' ') }} €</p>
                                <p class="card-text"><strong>État :</strong> {{ $annonce->etat }}</p>
                                <p class="card-text"><strong>Ville :</strong> {{ $annonce->ville }}</p>
                                <p class="card-text"><strong>Adresse :</strong> {{ $annonce->adresse }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-primary btn-sm">Voir détails</a>

                                <div>
                                    @if(Auth::check() && Auth::user()->favoris->contains($annonce->id))
                                        <!-- Formulaire pour supprimer des favoris -->
                                        <form action="{{ route('favoris.supprimer', ['bienImmoId' => $annonce->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer des favoris</button>
                                        </form>
                                    @else
                                        <!-- Formulaire pour ajouter aux favoris -->
                                        <form action="{{ route('favoris.ajouter', ['bienImmoId' => $annonce->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Ajouter aux favoris</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

</div>
@endsection
