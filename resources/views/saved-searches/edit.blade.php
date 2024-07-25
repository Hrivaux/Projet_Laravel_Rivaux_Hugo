@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Modifier la Recherche Sauvegardée</h1>
    
    <form action="{{ route('saved-searches.update', $search->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Champs de recherche à modifier -->
        <div class="row g-3">
            <div class="col-md-4">
                <label for="name" class="form-label">Nom de la recherche</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $search->name }}" required>
            </div>
            <div class="col-md-4">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="{{ $search->search_criteria['ville'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="prix_min" class="form-label">Prix Min</label>
                <input type="number" class="form-control" id="prix_min" name="prix_min" value="{{ $search->search_criteria['prix_min'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="prix_max" class="form-label">Prix Max</label>
                <input type="number" class="form-control" id="prix_max" name="prix_max" value="{{ $search->search_criteria['prix_max'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="superficie_min" class="form-label">Superficie Min</label>
                <input type="number" class="form-control" id="superficie_min" name="superficie_min" value="{{ $search->search_criteria['superficie_min'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="superficie_max" class="form-label">Superficie Max</label>
                <input type="number" class="form-control" id="superficie_max" name="superficie_max" value="{{ $search->search_criteria['superficie_max'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="">-- Sélectionnez --</option>
                    <option value="appartement" {{ ($search->search_criteria['type'] ?? '') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                    <option value="maison" {{ ($search->search_criteria['type'] ?? '') == 'maison' ? 'selected' : '' }}>Maison</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="ordre" class="form-label">Ordre</label>
                <select class="form-select" id="ordre" name="ordre">
                    <option value="prix_asc" {{ ($search->search_criteria['ordre'] ?? '') == 'prix_asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="prix_desc" {{ ($search->search_criteria['ordre'] ?? '') == 'prix_desc' ? 'selected' : '' }}>Prix décroissant</option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </form>
</div>
@endsection
