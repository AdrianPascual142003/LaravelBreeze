@extends('layouts/plantilla')
@section('titulo', 'Categorias')
@section('contenido')
    <br>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" required="required" class="form-control"">
        </div>
        @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
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
