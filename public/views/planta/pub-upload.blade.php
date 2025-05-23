<!DOCTYPE html>
<html>
<head>
    <title>Upload de Fotos</title>
    <script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                document.getElementById('latitude').value = pos.coords.latitude;
                document.getElementById('longitude').value = pos.coords.longitude;
            });
        }
    }
    window.onload = getLocation;
    </script>
</head>
<body>
    <h1>{{ $planta->nome }}</h1>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto"><br>
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="submit">Enviar Foto</button>
    </form>
</body>
</html>