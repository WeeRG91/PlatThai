@extends('layouts.admin')

@section('title', 'Edition d\'un plat')

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
            <h3>Edition du {{$plat->titre}}</h3>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{route('plat.update')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$plat->id}}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="titre" class="form-label">Titre</label>
                        <input id="titre" type="text" name="titre" class="form-control" required value="{{old('titre') ?? $plat->titre}}">
                    </div>
                    <div class="col-md-4">
                        <label for="titre_thai" class="form-label">Titre thai</label>
                        <input id="titre_thai" type="text" name="titre_thai" class="form-control" value="{{old('titre_thai') ?? $plat->titre_thai}}">
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
                             data-default-value='@json($selectedSpicyLevel)'
                        ></div>
                    </div>
                    <div class="col-md-4">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <div class="react-select"
                             data-options='@json($ingredients)'
                             data-name="ingredients[]"
                             data-is-multi='@json(true)'
                             data-default-value='@json($selectedIngredients)'
                        ></div>
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label">Prix</label>
                        <input id="price" type="number" step="0.01" min="0" name="price" class="form-control" value="{{old('price') ?? $plat->price}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea required id="description" name="description" class="form-control">{{old('description') ?? $plat->description}}</textarea>
                    </div>
                </div>
                <div class="row">
                    @foreach($plat->images as $image)
                        <div class="col-md-4 mt-3">
                            <div class="position-relative">
                                <img class="img-fluid" src="/storage/{{$image->path}}" alt="{{$image->nom}}">
                                <a href="{{route('image.delete', $image->id)}}" class="btn btn-sm btn-danger position-absolute" style="top:5px;right:5px;"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="{{route('plat.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button form="edit-form" type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check me-2"></i>Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection


