@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Registro</h1>
    <form action="{{ route('registros.store') }}" method="POST">
        @csrf
        @include('registros._form', ['registro' => null])
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
