@extends('layouts.admin')

@section('title', 'Edition d\'un ingredient')

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
            <h3>Edition de {{$ingredient->name}}</h3>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{route('admin.ingredient.update', $ingredient)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Titre</label>
                            <input id="name" type="text" name="name" class="form-control" required value="{{old('name') ?? $ingredient->name}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Sélectionner une image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label  class="form-label d-block">Allergène ?</label>
                            <label for="is_allergen" class="switch">
                                <input type="checkbox" name="is_allergen" {{$ingredient->is_allergen ? 'checked': null}} id="is_allergen" value="1">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <div class="react-wysiwyg"
                                 data-name='@json('description')'
                                 data-value='@json(old('description') ?? $ingredient->description)'
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <div class="position-relative">
                            @if($ingredient->image)
                                <img class="img-fluid" src="/storage/{{$ingredient->image->path}}" alt="{{$ingredient->image->nom}}">
                                <a href="{{route('admin.image.delete', $ingredient->image->id)}}" class="btn btn-sm btn-danger position-absolute" style="top:5px;right:5px;"><i class="fa fa-times"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="{{route('admin.ingredient.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button form="edit-form" type="submit" class="btn btn-success btn-sm">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
