@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Registro</h1>
    <form action="{{ route('registros.update', $registro->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('registros._form', ['registro' => $registro])
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
