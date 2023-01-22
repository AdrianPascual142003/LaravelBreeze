@extends('.layouts/plantilla')
@section('titulo','Inicio')
@section('contenido')
        @foreach($gangas as $ganga)
            <div class="container py-3">
                <div class="card p-4">
                    <div class="row ">
                        <div class="col-md-4">
                            <img src="{{asset("/storage/img/$ganga->id-ganga-severa.jpg")}}" class="w-100">
                        </div>
                        <div class="col-md-8 px-3">
                            <div class="card-block px-3">
                                <h4 class="card-title">{{$ganga->title}}</h4>
                                <p class="card-text">{{$ganga->description}}</p>
                                <li class="btn btn-primary">
                                    {{$ganga->likes}}
                                    <i class="bi bi-hand-thumbs-up"></i>
                                </li>
                                <li class="btn btn-danger">
                                    {{$ganga->unlikes}}
                                    <i class="bi bi-hand-thumbs-down"></i>
                                </li>
                                <a href="{{route('gangas.show', $ganga->id)}}" class="btn btn-danger">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container">
            {{ $gangas->links('pagination::bootstrap-5') }}
        </div>
@endsection


