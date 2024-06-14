@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }}</h1>

        <!-- Section Mes annonces Favorites -->
        <div class="mt-4">
            <h2>Mes annonces Favorites</h2>
            
            @if ($favoris->count() > 0)
                <div class="row">
                    @foreach ($favoris as $favori)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if ($favori->photos->isNotEmpty())
                                    <img src="{{ asset('storage/images/' . $favori->photos->first()->image) }}" class="card-img-top" style="height: 200px;" alt="{{ $favori->libelle }}">
                                @else
                                    <img src="https://via.placeholder.com/150" class="card-img-top" style="height: 200px;" alt="{{ $favori->libelle }}">
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
        
        <!-- Informations personnelles de l'utilisateur -->
        <div class="mt-4">
            <h2>Mes informations personnelles</h2>

            <form action="{{ route('moncompte.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
@endsection
