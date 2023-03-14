@extends('layouts.admin')

@section('title', 'Listing des plats')

@section('content')
    <div class="card main">
        <div class="card-header">
            <h3>Listing des plats</h3>
            <div>
                <a href="{{route('admin.plat.create')}}" class="btn btn-info btn-sm">Créer un plat</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.plat.index')}}" method="get">
            <div class="row">
                <div class="col-md-3">
                        <label for="search" class="form-label">Rechercher</label>
                        <input id="search" type="text" name="search" class="form-control" value="{{old('search')}}">
                </div>
                    <div class="col-md-3">
                        <div>
                            <label for="ingredients" class="form-label">Ingredients</label>
                            <div class="react-select"
                                 data-options='@json($ingredients)'
                                 data-name="ingredients[]"
                                 data-is-multi='@json(true)'
                                 data-default-value='@json($selectedIngredients)'
                            ></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="spicy_level" class="form-label">Niveau d'épice</label>
                        <div class="react-select"
                             data-options='@json($spicyLevelTypes)'
                             data-name="spicy_level"
                             data-default-value='@json($selectedSpicy)'
                        ></div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex h-100 align-items-end">
                            <button class="btn btn-primary">Rechercher</button>
                        </div>
                    </div>
            </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="listing table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <a href="{{route('admin.plat.index',
                                            ['ingredients'=> request()->get('ingredients'), 'spicy_level'=> request()->get('spicy_level'), 'order_by'=>'id',
                                            'direction' => request()->get('direction') === 'asc' ? 'desc' : 'asc' ])}}"
                                            class="btn btn-outline-secondary btn-sm btn-sm"
                                    >ID</a>
                                </th>
                                <th>
                                    <a href="{{route('admin.plat.index',
                                            ['ingredients'=> request()->get('ingredients'), 'spicy_level'=> request()->get('spicy_level'), 'order_by'=>'titre',
                                            'direction' => request()->get('direction') === 'asc' ? 'desc' : 'asc' ])}}"
                                            class="btn btn-outline-secondary btn-sm btn-sm"
                                    >Titre</a>
                                </th>
                                <th>Titre thai</th>
                                <th>Description</th>
                                <th>Ingrédients</th>
                                <th>Spicy level</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($plats as $plat)
                                <tr>
                                    <td>{{$plat->id}}</td>
                                    <td>{{$plat->titre}}</td>
                                    <td>{{$plat->titre_thai}}</td>
                                    <td>{!! $plat->description !!}</td>
                                    <td>
                                        <ul>
                                            @foreach($plat->ingredients as $ingredient)
                                                <li>{{$ingredient->name}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {!! $plat->getAttribute('icons') !!}
                                        <div>
                                            {{\App\Enums\SpicyLevelType::getDescription($plat->spicy_level)}}
                                        </div>
                                    </td>
                                    <td>{{$plat->price}}€</td>
                                    {{--<td><a href="{{route('plat.edit', ['id'=>$plat->id])}}" class="btn btn-sm btn-success">Editer</a></td>--}}
                                    <td>
                                        <a href="{{route('admin.plat.edit', $plat)}}" class="btn btn-sm btn-success">Editer</a>
                                        <a href="{{route('admin.plat.delete', $plat)}}" class="btn btn-sm btn-danger btn-delete">Supprimer</a>
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
@section('script')
    <script>
        let elements = document.querySelectorAll('.btn-delete')
        elements.forEach(el => {
            el.addEventListener('click', (e)=> {
                e.preventDefault()
                let result = confirm('Est-ce que vous souhaitez vraiment supprimer ?')
                if(result === true) {
                    document.location = el.href
                }else{
                    console.log('click sur annuler')
                }
            })
        })

        /*
         let elements = document.querySelectorAll('.btn-delete')
        elements.forEach(el => {
            el.addEventListener('click', (e)=> traiterSuppression(e, el))
        })

        function traiterSuppression(evenement, el){
            evenement.preventDefault()
            let result = confirm('Est-ce que vous souhaitez vraiment supprimer ?')
            if(result === true) {
                document.location = el.href
            }else{
                console.log('click sur annuler')
            }
        }
         */
        /*
        element.onclick = (e) => {
            e.preventDefault()
            console.log(e)
        }

         */
        /*
        element.addEventListener('click', (e)=> {
            e.preventDefault()
            console.log(e)
        })
         */
        /*
        let trs = document.querySelectorAll('#tab-plats tr')
        trs.forEach(el=> {
            el.addEventListener('mouseover', (e)=> {
                el.classList.add('table-info')
            })
            el.addEventListener('mouseleave', (e)=> {
                el.classList.remove('table-info')
            })
        })
        */
        /*
        tab.addEventListener('mouseover', ()=> {
            tab.classList.add('bg-danger')
        })

         */

    </script>
@endsection
