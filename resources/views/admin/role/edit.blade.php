@extends('layouts.admin')

@section('title', 'Edition d\'un role')

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
            <h3>Edition du {{$role->name}}</h3>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{route('admin.role.update', $role)}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$role->id}}">
                @csrf
                <div class="row">
                    @foreach($permissionTypes as $type)
                        <div class="col-md-3">
                            <h4>{{$type['label']}}</h4>
                            @foreach($permissions->where('type', $type['value']) as $permission)
                                <label  class="form-label d-block">{{$permission->name}}</label>
                                <label for="permission_{{$permission->id}}" class="switch">
                                    <input type="checkbox" {{$role->hasPermissionTo($permission->name) ? 'checked' : null}}  name="permissions[]" id="permission_{{$permission->id}}" value="{{$permission->id}}">
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
                    <a href="{{route('admin.role.index')}}" class="btn btn-sm btn-secondary">Retour</a>
                    <button form="edit-form" type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check me-2"></i>Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection


