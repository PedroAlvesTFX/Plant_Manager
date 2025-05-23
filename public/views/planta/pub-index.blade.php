<!DOCTYPE html>
<html>
<head><title>Cadastro de Plantas</title>
</head>
<body>
    <h1>Nova Planta Editado</h1>
    <form action="/admin/planta" method="POST">
        @csrf
        <input name="name" placeholder="Nome"><br>
        <input name="description" placeholder="Descricao"><br>
        <input name="species" placeholder="Espécie"><br>
        <input name="location" placeholder="Local"><br>
        <input name="data_plantio" type="date"><br>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Plantas Cadastradas</h2>
    <ul>
        @foreach($plantas as $planta)
            <li>{{ $planta->name }} - <a href="/admin/planta/{{ $planta->id }}/edit">QR</a> --  <a href="{{ route('plantas.edit', $planta->id) }}">Editar</a> </li>
        @endforeach
    </ul>
</body>
</html>