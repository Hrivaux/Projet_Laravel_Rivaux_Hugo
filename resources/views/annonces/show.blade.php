@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-light mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $annonce->libelle }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    @if($annonce->photos->isNotEmpty())
                        <div id="carouselExampleControls" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach($annonce->photos as $key => $photo)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $photo->image) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $annonce->libelle }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #000;"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #000;"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/800x400" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $annonce->libelle }}">
                        <p class="text-center mt-2">Aucune photo disponible pour cette annonce.</p>
                    @endif
                </div>

                <div class="col-md-6">
                    <h5 class="mb-4">Détails de l'Annonce</h5>

                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-cash me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <div>
                                <h6 class="mb-1">Prix</h6>
                                <p class="mb-0 fs-5">{{ number_format($annonce->prix, 2, ',', ' ') }} €</p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-gear me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <div>
                                <h6 class="mb-1">État</h6>
                                <p class="mb-0 fs-5">{{ $annonce->etat }}</p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-file-text me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <div>
                                <h6 class="mb-1">Description</h6>
                                <p class="mb-0">{{ $annonce->description }}</p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-house-door me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <div>
                                <h6 class="mb-1">Adresse</h6>
                                <p class="mb-0">{{ $annonce->adresse }}, {{ $annonce->ville }} {{ $annonce->code_postal }}</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-file-text me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <div>
                                <h6 class="mb-1">Superficie</h6>
                                <p class="mb-0">{{ $annonce->superficie }}</p>
                            </div>
                        </div><div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-file-text me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <div>
                                <h6 class="mb-1">Type</h6>
                                <p class="mb-0">{{ $annonce->type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                @if(Auth::check())
                    @if(Auth::user()->favoris->contains($annonce->id))
                        <form action="{{ route('favoris.supprimer', ['bienImmoId' => $annonce->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Retirer des favoris</button>
                        </form>
                    @else
                        <form action="{{ route('favoris.ajouter', ['bienImmoId' => $annonce->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Ajouter aux favoris</button>
                        </form>
                    @endif
                @endif
                <a href="{{ url('/') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection
