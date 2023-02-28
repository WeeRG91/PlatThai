@extends('layouts.app')

@section('title', 'Edition d\'un plat')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-danger text-center">Edition du {{$plat->titre}}</h1>
            </div>
        </div>
        <form action="{{route('plat.update')}}" method="POST" enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea required id="description" name="description" class="form-control">{{old('description') ?? $plat->description}}</textarea>
                </div>
                <div class="col-md-4">
                    <label for="spicy_level" class="form-label">Niveau d'épice</label>
                    <div
                        class="react-select"
                        options='@json($spicyLevelTypeReact)'
                        name="spicy_level"
                        value='@json(\Illuminate\Support\Arr::first($spicyLevelTypeReact,fn($el, $key)=> $el['value'] === $plat->spicy_level))'
                    ></div>
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
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <a href="{{route('plat.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check me-2"></i>Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
@endsection


