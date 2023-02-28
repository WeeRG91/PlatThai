@extends('layouts.app')

@section('title', 'Listing des ingredients')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-end">
                <a href="{{route('ingredient.create')}}" class="btn btn-info btn-sm">Créer un ingredient</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tab-ingredients" class="table table-striped table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th class="text-center" style="width: 30px;">ID</th>
                            <th class="text-center" style="width: 200px;">Image</th>
                            <th>name</th>
                            <th>Description</th>
                            <th class="text-center" style="width: 75px;">Allergène</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td>{{$ingredient->id}}</td>
                                <td>
                                    @if($ingredient->image)
                                    <img class="img-fluid" src="/storage/{{$ingredient->image->path}}" alt="{{$ingredient->image->nom}}">
                                    @endif
                                </td>
                                <td>{{$ingredient->name}}</td>
                                <td>{{$ingredient->description}}</td>
                                <td class="text-center"> {!! $ingredient->is_allergen === 1 ? '<i class="fa-solid fa-exclamation h3 text-danger"></i>' : '<i class="fa-solid fa-circle text-success"></i>' !!}</td>

                                {{--<td><a href="{{route('plat.edit', ['id'=>$plat->id])}}" class="btn btn-sm btn-success">Editer</a></td>--}}
                                <td>
                                    <a href="{{route('ingredient.edit', $ingredient)}}" class="btn btn-sm btn-success">Editer</a>
                                    <a href="{{route('ingredient.delete', $ingredient)}}" class="btn btn-sm btn-danger btn-delete">Supprimer</a>
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

        let trs = document.querySelectorAll('#tab-ingredients tr')
        trs.forEach(el=> {
            el.addEventListener('mouseover', (e)=> {
                el.classList.add('table-info')
            })
            el.addEventListener('mouseleave', (e)=> {
                el.classList.remove('table-info')
            })
        })
        /*
        tab.addEventListener('mouseover', ()=> {
            tab.classList.add('bg-danger')
        })

         */

    </script>
@endsection
