@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registros</h1>
    <a href="{{ route('registros.create') }}" class="btn btn-primary mb-3">Novo Registro</a>

    @if($registros->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Planta</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->id }}</td>
                    <td>{{ $registro->planta->nome_popular ?? 'N/A' }}</td>
                    <td>{{ $registro->descricao }}</td>
                    <td>{{ $registro->tipo }}</td>
                    <td>{{ $registro->data->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('registros.show', $registro->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('registros.edit', $registro->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('registros.destroy', $registro->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma a exclusão?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $registros->links() }}
    @else
        <p>Nenhum registro encontrado.</p>
    @endif
</div>
@endsection
