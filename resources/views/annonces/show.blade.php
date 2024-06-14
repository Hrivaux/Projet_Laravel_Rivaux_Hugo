@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            {{ $annonce->libelle }}
        </div>
        <div class="card-body">
            <p>Prix : {{ number_format($annonce->prix, 2, ',', ' ') }} €</p>
            <p>État : {{ $annonce->etat }}</p>
            <p>Description : {{ $annonce->description }}</p>
            <p>Adresse : {{ $annonce->adresse }}, {{ $annonce->ville }} {{ $annonce->code_postal }}</p>

            <!-- Affichage des photos de l'annonce -->
            @if($annonce->photos->isNotEmpty())
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($annonce->photos as $photo)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/images/' . $photo->image) }}" class="d-block w-100" alt="{{ $annonce->libelle }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @else
            <p>Aucune photo disponible pour cette annonce.</p>
            @endif
            <!--<div id="googleMap" style="height: 400px; margin-top: 20px;"></div>-->
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
