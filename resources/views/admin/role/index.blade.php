@extends('layouts.admin')

@section('title', 'Listing des roles')

@section('content')
    <div class="card main">
        <div class="card-header">
            <h3>Listing des roles</h3>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="listing table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                    <li>{{$permission->name}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.role.edit', $role)}}" class="btn btn-sm btn-success">Editer</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

