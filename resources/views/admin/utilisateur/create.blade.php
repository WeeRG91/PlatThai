@extends('layouts.admin')

@section('title', 'Création de utilisateur')

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
            <h3>Création d'un utilisateur</h3>
        </div>
        <div class="card-body">
            <form id="create-form" action="{{route('admin.utilisateur.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input id="name" type="text" name="name" class="form-control" required value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="text" name="email" class="form-control" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Sélectionner une image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input id="password" type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmation de mot de passe</label>
                            <input id="password_confirm" type="password" name="password_confirm" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    @foreach($permissionTypes as $type)
                        <div class="col-md-3">
                            <h4>{{$type['label']}}</h4>
                            @foreach($permissions->where('type', $type['value']) as $permission)
                                <label  class="form-label d-block">{{$permission->name}}</label>
                                <label for="permission_{{$permission->id}}" class="switch">
                                    <input type="checkbox" name="permissions[]" id="permission_{{$permission->id}}" value="{{$permission->id}}">
                                    <span class="slider round"></span>
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="{{route('admin.utilisateur.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button form="create-form" type="submit" class="btn btn-success btn-sm">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
