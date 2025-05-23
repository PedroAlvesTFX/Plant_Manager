@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Cadastrar Planta</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('plantas.store', $planta->id) }}" method="POST">
        @csrf
        @method('POST')

        <label for="nome_popular">Nome da Planta:</label>
        <input type="text" id="nome_popular" name="nome_popular" value="{{ old('nome_popular', $planta->nome_popular) }}"><br>

        <label for="description">Nome Cientifico:</label>
        <textarea id="especie" name="especie"></textarea><br>

        <label for="e_panc">E Panc:</label>
        <input type="checkbox" id="e_panc" name="e_panc"    >

        <label for="e_apicola">E Apicola:</label>
        <input type="checkbox" id="e_apicola" name="e_apicola"  >

        <label for="e_forrageira">E forrageira:</label>
        <input type="checkbox" id="e_forrageira" name="e_forrageira" >

    

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
        <button type="submit" class="btn-outline-primary" >Cadastrar</button>
    </form>

    <br>
    <a href="{{ url('/plantas') }}"> Voltar à lista</a>
</div>
</div>
@endsection
