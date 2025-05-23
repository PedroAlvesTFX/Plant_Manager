@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Editar Planta</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('plantas.update', $planta->id  ) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome_popular">Nome da Planta:</label>
        <input type="text" id="nome_popular" name="nome_popular" value="{{ old('nome_popular', $planta->nome_popular) }}"><br>

        <label for="description">Espécie:</label>
        <textarea id="especie" name="especie">{{ old('especie', $planta->especie) }}</textarea><br>

        <label for="e_panc">E Panc:</label>
        <input type="checkbox" id="e_panc" name="e_panc"   {{ old('e_panc', $planta->e_panc ?? false) ? 'checked' : '' }} >

        <label for="e_apicola">E Apicola:</label>
        <input type="checkbox" id="e_apicola" name="e_apicola"  {{ old('e_apicola', $planta->e_apicola ?? false) ? 'checked' : '' }} >

        <label for="e_forrageira">E forrageira:</label>
        <input type="checkbox" id="e_forrageira" name="e_forrageira"  {{ old('e_forrageira', $planta->e_forrageira ?? false) ? 'checked' : '' }} >


<style>
.container {
  display: grid;
  grid-template-columns: repeat(2, 150px);
  gap: 10px;
}

.button {
  height: 100px;
  background-color: #cee;
}
</style>

<div class="container">
        <button type="submit" class="btn-outline-primary" >Salvar Alterações</button>
    </form>

<form action="{{ route('plantas.destroy',$planta->id) }}" method="POST" 
onsubmit="return confirm('Tem certeza que deseja deletar esta planta, {{ $planta->nome_popular.'-'. $planta->id }} ?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Deletar</button>
</form>
</div>
   {{ $planta->id   }} {{ $planta->name }}
    <br>
    <a href="{{ url('/plantas') }}"> Voltar à lista</a>
</div>
@endsection
