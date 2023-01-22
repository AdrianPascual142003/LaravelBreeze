@extends('layouts/plantilla')
@section('titulo', 'Categorias')
@section('contenido')
    <br>
    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" required="required" class="form-control"  value="{{old('nombre') ?? $category->name}}">
        @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
<style>
    form {
        width: 30%;
        margin: 0 auto;
    }
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
