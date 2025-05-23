<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Ativa</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($plantas as $planta)
            
            <tr>
                <td><a href="/admin/planta/{{ $planta->id }}/edit">{{ $planta->id }}</a></td>
                <td>{{ $planta->nome_popular }}</a></td>
                <td>{{ $planta->e_panc ? 'Sim' : 'Não' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Nenhuma planta encontrada.</td>
            </tr>
        @endforelse
    </tbody>
</table>
