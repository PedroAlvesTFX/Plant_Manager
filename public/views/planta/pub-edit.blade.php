@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Planta</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('plantas.update', $planta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nome da Planta:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name', $planta->name) }}"><br><br>

        <label for="description">Descrição:</label><br>
        <textarea id="description" name="description">{{ old('description', $planta->description) }}</textarea><br><br>

        <label for="species">Especies:</label><br>
        <textarea id="species" name="species">{{ old('species', $planta->species) }}</textarea><br><br>


        <label for="species">Local:</label><br>
        <textarea id="location" name="location">{{ old('location', $planta->location) }}</textarea><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
   {{ $planta->id   }} {{ $planta->name }}
    <br>
    <a href="{{ url('/admin/planta') }}"> Voltar à lista</a>
</div>
@endsection
