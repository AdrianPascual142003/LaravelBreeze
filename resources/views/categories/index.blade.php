@extends('layouts/plantilla')
@section('titulo', 'Categorias')
@section('contenido')
    <br>
    <table class="table text-center container">
        <thead class="thead-danger bg-danger">
        <tr class="text-light">
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <th>{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-danger" href="{{route('categories.edit',$category->id)}}">Editar</a>
                            <input type="submit" value="Borrar" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
@endsection
<style>
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
