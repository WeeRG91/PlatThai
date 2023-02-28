@extends('layouts.app')

@section('title', 'Création de plat')

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
                <h1 class="text-danger text-center">Création de plat</h1>
            </div>
        </div>
        <form action="{{route('plat.store')}}" method="POST" enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea required id="description" name="description" class="form-control">{{old('description')}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="{{route('plat.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success btn-sm">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
@endsection
