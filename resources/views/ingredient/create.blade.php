@extends('layouts.app')

@section('title', 'Création d\'un ingredient')

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
                <h1 class="text-danger text-center">Création de ingredient</h1>
            </div>
        </div>
        <form action="{{route('ingredient.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="name" class="form-label">Titre</label>
                    <input id="name" type="text" name="name" class="form-control" required value="{{old('name')}}">
                </div>
                <div class="col-md-4">
                    <label for="image" class="form-label">Sélectionner une image</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <div class="col-md-4">
                    <label  class="form-label d-block">Allergène ?</label>
                    <label for="is_allergen" class="switch">
                        <input type="checkbox" name="is_allergen" id="is_allergen" value="1">
                        <span class="slider round"></span>
                    </label>
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
                    <a href="{{route('ingredient.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success btn-sm">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
@endsection
