@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'annonce</h1>

    <form action="{{ route('annonces.update', $annonce->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="libelle" class="form-label">Libellé</label>
            <input type="text" class="form-control" id="libelle" name="libelle" value="{{ old('libelle', $annonce->libelle) }}" required>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="{{ old('prix', $annonce->prix) }}" required>
        </div>

        <div class="mb-3">
            <label for="etat" class="form-label">État</label>
            <input type="text" class="form-control" id="etat" name="etat" value="{{ old('etat', $annonce->etat) }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $annonce->adresse) }}" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville', $annonce->ville) }}" required>
        </div>

        <div class="mb-3">
            <label for="code_postal" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ old('code_postal', $annonce->code_postal) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $annonce->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="superficie" class="form-label">Superficie (m²)</label>
            <input type="number" step="0.01" class="form-control" id="superficie" name="superficie" value="{{ old('superficie', $annonce->superficie) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type de bien</label>
            <select class="form-select" id="type" name="type" required>
                <option value="" disabled>-- Sélectionnez un type --</option>
                <option value="appartement" {{ old('type', $annonce->type) == 'appartement' ? 'selected' : '' }}>Appartement</option>
                <option value="maison" {{ old('type', $annonce->type) == 'maison' ? 'selected' : '' }}>Maison</option>
                <option value="studio" {{ old('type', $annonce->type) == 'studio' ? 'selected' : '' }}>Studio</option>
                <option value="loft" {{ old('type', $annonce->type) == 'loft' ? 'selected' : '' }}>Loft</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>
@endsection
