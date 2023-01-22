@extends('.layouts/plantilla')
@section('titulo','Producto')
@section('contenido')
    <div>
        <div class="container mt-4 mb-4">
            <div class="card">
                <div class="row">
                    <div class="col-4 pt-3">
                        <img src="{{asset("/storage/img/$ganga->id-ganga-severa.jpg")}}" class="w-100">
                    </div>
                    <div class="col-8">
                        <h1>{{$ganga->title}}</h1>
                        <p>{{$ganga->description}}</p>
                        <h1 class=""><b><del class="text-danger">{{$ganga->price_sale}}€</del> <span class="text-warning">{{$ganga->price}}€</span></b></h1>
                        <h5 class="d-inline">Categoria: {{$ganga->categoria->name}}</h5>
                        <a href="{{'http://'.$ganga->url}}" class="ml-2 btn btn-light">🌐</a>
                        @if($ganga->user_id == Auth::id() || Auth::user()->rol === "admin")
                        <form action="{{route('gangas.destroy',$ganga->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Borrar" class="btn btn-danger">
                            <a class="btn btn-danger" href="{{route('gangas.edit',$ganga->id)}}">Editar</a>
                        </form>
                        @endif
                        <div class="row">
                            <div class="col-3">
                                <a class="btn btn-primary" href="{{route('gangas.like', $ganga->id)}}">
                                    {{$ganga->likes}}
                                    <i class="bi bi-hand-thumbs-up"></i>
                                </a>
                                <a class="btn btn-danger" href="{{route('gangas.dislike', $ganga->id)}}">
                                    {{$ganga->unlikes}}
                                    <i class="bi bi-hand-thumbs-down"></i>
                                </a>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <p class="mt-2">Fecha de creación: {{$ganga->created_at ? $ganga->created_at->format('d/m/Y') : 'No especificada'}}</p>
                                </h5>
                            </div>
                            <div class="col-1 pb-2">
                                <a href="{{route('gangas.index')}}" class="btn btn-danger">Atrás</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
