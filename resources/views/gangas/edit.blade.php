@extends('layouts.plantilla')
@section('titulo','Añadir chollo')
@section('contenido')
    <h1 class="text-center">Editar Producto</h1>
    <div class="container">
        <form method="post" action="{{route('gangas.update',$ganga->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group mt-3">
                <label for="title">Titulo:</label>
                <input id="title" name="title" type="text" required="required" class="form-control" value="{{old('title') ?? $ganga->title}}">
            </div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" cols="40" rows="3" class="form-control" required="required">{{old('descripcion') ?? $ganga->description}}</textarea>
            </div>
            @error('descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="url">Link del producto</label>
                <input id="url" name="url" type="text" class="form-control" required="required" value="{{old('url') ?? $ganga->url}}">
            </div>
            @error('url')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="select">Categoria</label>
                <div>
                    <select id="categorias" name="categorias" class="custom-select" required="required">
                        <option selected value="{{$ganga->category}}">{{$ganga->categoria->name}}</option>
                        @foreach($categorias as $category)
                            @if(($category->id != $ganga->category))
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @error('categorias')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="precio">Precio</label>
                <input id="precio" name="precio" type="number" class="form-control" required="required" value="{{old('precio') ?? $ganga->price}}">
            </div>
            @error('precio')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="precio_salida">Precio de salida</label>
                <input id="precio_salida" name="precio_salida" type="number" class="form-control" required="required" value="{{old('precio_salida') ?? $ganga->price_sale}}">
            </div>
            @error('precio_salida')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group"> <!-- Street 1 -->
                <label for="imagen" class="control-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" value="{{old('imagen') ?? "public/img/$ganga->id-ganga-severa.jpg"}} ">
            </div>
            @error('imagen')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="disponible">Disponible</label>
                <input type="checkbox" name="disponible" id="disponible"  {{ $ganga->available ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary">Añadir</button>
            </div>
        </form>
    </div>
@endsection
<style>
    form {
        width: 50%;
        margin: 0 auto;
    }
</style>
