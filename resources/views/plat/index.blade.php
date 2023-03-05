@extends('layouts.admin')

@section('title', 'Listing des plats')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-end">
                <a href="{{route('plat.create')}}" class="btn btn-info btn-sm">Créer un plat</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="listing table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
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
                                <td>{{$plat->description}}</td>
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
                                    <a href="{{route('plat.edit', $plat)}}" class="btn btn-sm btn-success">Editer</a>
                                    <a href="{{route('plat.delete', $plat)}}" class="btn btn-sm btn-danger btn-delete">Supprimer</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
