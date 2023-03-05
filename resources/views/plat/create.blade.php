@extends('layouts.admin')

@section('title', 'Création de plat')

@section('content')
@if($errors->any())

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card main">
        <div class="card-header">
            <h3>Création d'un plat</h3>
        </div>
        <div class="card-body">
            <form id="create-form" action="{{route('plat.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="titre" class="form-label">Titre</label>
                        <input id="titre" type="text" name="titre" class="form-control" required value="{{old('titre')}}">
                    </div>
                    <div class="col-md-4">
                        <label for="titre_thai" class="form-label">Titre thai</label>
                        <input id="titre_thai" type="text" name="titre_thai" class="form-control" value="{{old('titre_thai')}}">
                    </div>
                    <div class="col-md-4">
                        <label for="images" class="form-label">Sélectionner des images</label>
                        <input multiple class="form-control" type="file" name="images[]" id="images">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="spicy_level" class="form-label">Niveau d'épice</label>
                        <div class="react-select"
                             data-options='@json($spicyLevelTypeReact)'
                             data-name="spicy_level"
                        ></div>
                    </div>
                    <div class="col-md-4">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <div class="react-select"
                             data-options='@json($ingredients)'
                             data-name="ingredients[]"
                             data-is-multi='@json(true)'
                        ></div>
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label">Prix</label>
                        <input id="price" type="number" step="0.01" min="0" name="price" class="form-control" value="{{old('price')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea required id="description" name="description" class="form-control">{{old('description')}}</textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="{{route('plat.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button form="create-form" type="submit" class="btn btn-success btn-sm">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
