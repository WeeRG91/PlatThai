@extends('layouts.admin')

@section('title', 'Edition d\'un utilisateur')

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
            <h3>Edition du {{$user->name}}</h3>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{route('admin.utilisateur.update', $user)}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$user->id}}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input id="name" type="text" name="name" class="form-control" required value="{{old('name') ?? $user->name}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="text" name="email" class="form-control" value="{{old('email') ?? $user->email}}">
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
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input id="password" type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmation de mot de passe</label>
                            <input id="password_confirm" type="password" name="password_confirm" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="position-relative">
                            @if($user->image)
                                <img class="img-fluid" src="/storage/{{$user->image->path}}" alt="{{$user->image->nom}}">
                                <a href="{{route('admin.image.delete', $user->image->id)}}" class="btn btn-sm btn-danger position-absolute" style="top:5px;right:5px;"><i class="fa fa-times"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-3">
                            <h4>Roles</h4>
                            @foreach($roles as $role)
                                <label  class="form-label d-block">{{$role->name}}</label>
                                <label for="roles_{{$role->id}}" class="switch">
                                    <input type="checkbox" {{$user->hasRole($role->name) ? 'checked' : null}}  name="roles[]" id="roles_{{$role->id}}" value="{{$role->id}}">
                                    <span class="slider round"></span>
                                </label>
                            @endforeach
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
                                    <input type="checkbox" {{$user->hasDirectPermission($permission->name) ? 'checked' : null}}  name="permissions[]" id="permission_{{$permission->id}}" value="{{$permission->id}}">
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
                    <button form="edit-form" type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check me-2"></i>Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection


