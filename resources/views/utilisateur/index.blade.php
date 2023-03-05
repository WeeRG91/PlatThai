@extends('layouts.admin')

@section('title', 'Listing des plats')

@section('content')
    <div class="card main">
        <div class="card-header">
            <h3>Listing des utilisateurs</h3>
            <div>
                <a href="{{route('utilisateur.create')}}" class="btn btn-info btn-sm">Créer un utilisateur</a>
            </div>
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
                                <th>E-mail</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
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
