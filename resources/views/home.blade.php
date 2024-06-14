@extends('layouts.app')

@section('content')
<!-- En-tête -->
<header class="mb-4 header-background">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>

<!-- Corps de la page -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('Welcome back,') }} {{ Auth::user()->name }}!</p>
                    <p>{{ __('You are logged in!') }}</p>

                    <!-- Bouton de déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Déconnexion') }}</button>
                    </form>
                </div>
            </div>

            <!-- Section des annonces -->
            <div class="mt-4">
                <h2>Annonces</h2>
                <!-- Boucle pour afficher les annonces -->
                @if($annonces->isEmpty())
                    <p>Aucune annonce disponible pour le moment.</p>
                @else
                    <div class="row">
                        @foreach($annonces as $annonce)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            @if($annonce->photos->isNotEmpty())
                <img src="{{ asset('storage/images/' . $annonce->photos->first()->image) }}" class="card-img-top" style="height: 200px;" alt="{{ $annonce->libelle }}">
            @else
                <img src="https://via.placeholder.com/150" class="card-img-top" style="height: 200px;" alt="{{ $annonce->libelle }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $annonce->libelle }}</h5>
                <p class="card-text">Prix : {{ number_format($annonce->prix, 2, ',', ' ') }} €</p>
                <p class="card-text">État : {{ $annonce->etat }}</p>
            </div>
                            <a href="{{ route('annonce.show', ['id' => $annonce->id]) }}" class="btn btn-primary">Voir détails</a>

            <div class="card-footer">
                @if(Auth::check() && Auth::user()->favoris->contains($annonce->id))
                    <!-- Formulaire pour supprimer des favoris -->
                    <form action="{{ route('favoris.supprimer', ['bienImmoId' => $annonce->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Supprimer des favoris</button>
                    </form>
                @else
                    <!-- Formulaire pour ajouter aux favoris -->
                    <form action="{{ route('favoris.ajouter', ['bienImmoId' => $annonce->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Ajouter aux favoris</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endforeach


                    </div>

                @endif
                <!-- Fin de la boucle -->
            </div>
        </div>
    </div>
</div>

<!-- Pied de page -->
<footer class="mt-4 bg-primary text-white text-center p-3">
    © 2023 <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a> - Tous droits réservés
</footer>
@endsection
