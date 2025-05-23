<div class="mb-3">
    <label for="id_planta" class="form-label">Planta</label>
    <select name="id_planta" id="id_planta" class="form-control">
        <option value="">Selecione uma planta</option>
        @foreach($plantas as $planta)
            <option value="{{ $planta->id }}" 
                {{ (old('id_planta', $registro->id_planta ?? '') == $planta->id) ? 'selected' : '' }}>
                {{ $planta->nome_popular }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="id_usuario" class="form-label">Usuário (ID)</label>
    <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="{{ old('id_usuario', $registro->id_usuario ?? '') }}" placeholder="Informe o ID do usuário">
</div>

<div class="mb-3">
    <label for="descricao" class="form-label">Descrição</label>
    <textarea name="descricao" id="descricao" rows="3" class="form-control">{{ old('descricao', $registro->descricao ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <input type="text" class="form-control" name="tipo" id="tipo" value="{{ old('tipo', $registro->tipo ?? '') }}" placeholder="Informe o tipo (1 caractere)">
</div>

<div class="mb-3">
    <label class="form-label">Localização no Mapa</label>
    <div id="mapid" style="height: 300px;"></div>
    <small class="form-text text-muted">Clique no mapa para marcar a localização.</small>
</div>

<input type="hidden" name="lat" id="lat" value="{{ old('lat', $registro->lat ?? '') }}">
<input type="hidden" name="lon" id="lon" value="{{ old('lon', $registro->lon ?? '') }}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    var initLat = parseFloat(document.getElementById('lat').value) || -23.550520;
    var initLon = parseFloat(document.getElementById('lon').value) || -46.633308;
    var map = L.map('mapid').setView([initLat, initLon], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;
    if(document.getElementById('lat').value && document.getElementById('lon').value){
        marker = L.marker([initLat, initLon]).addTo(map);
    }

    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lon = e.latlng.lng.toFixed(6);
        document.getElementById('lat').value = lat;
        document.getElementById('lon').value = lon;

        if(marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
});
</script>
