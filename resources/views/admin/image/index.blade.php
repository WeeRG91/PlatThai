@extends('layouts.admin')

@section('title', 'Listing des images')

@section('content')
    <div class="card main">
        <div class="card-header">
            <h3>Liste des images</h3>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="listing table table-striped table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th class="text-center" style="width: 30px;">ID</th>
                                <th class="text-center" style="width: 30px;">Type</th>
                                <th>name</th>
                                <th class="text-center" style="width: 200px;">Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td>{{$image->id}}</td>
                                    <td>
                                        @if($image->model_class === \App\Models\Plat::class)
                                            <i class="fa-solid fa-utensils"></i>
                                        @elseif($image->model_class === \App\Models\Ingredient::class)
                                            <i class="fa-solid fa-carrot"></i>
                                        @elseif($image->model_class === \App\Models\User::class)
                                            <i class="fa-solid fa-users"></i>
                                        @endif
                                    </td>
                                    <td>{{$image->nom}}</td>
                                    <td>
                                        <a href="{{$image->getAttribute('model_link')}}"><img class="img-fluid" src="/storage/{{$image->path}}" alt="{{$image->nom}}"></a>
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

