@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Déposer un bien</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('deposer_bien.store') }}">
                            @csrf

                            <!-- Champs du formulaire pour déposer un bien -->
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

                            <!-- Autres champs à ajouter selon votre besoin -->

                            <button type="submit" class="btn btn-primary">Déposer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
