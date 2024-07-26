@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Déposer un bien</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('deposer_bien.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="libelle">Libellé du bien</label>
                                <input type="text" class="form-control" id="libelle" name="libelle" required>
                            </div>

                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="text" class="form-control" id="prix" name="prix" required>
                            </div>

                            <div class="form-group">
                                <label for="etat">État</label>
                                <select class="form-control" id="etat" name="etat" required>
                                    <option value="neuf">Neuf</option>
                                    <option value="bon état">Bon état</option>
                                    <option value="à rénover">À rénover</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                            </div>

                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville" required>
                            </div>

                            <div class="form-group">
                                <label for="code_postal">Code Postal</label>
                                <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="superficie">Superficie (en m²)</label>
                                <input type="text" class="form-control" id="superficie" name="superficie" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Type de bien</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="appartement">Appartement</option>
                                    <option value="maison">Maison</option>
                                    <option value="studio">Studio</option>
                                    <option value="loft">Loft</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="images">Photos</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>

                            <button type="submit" class="btn btn-primary">Déposer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
