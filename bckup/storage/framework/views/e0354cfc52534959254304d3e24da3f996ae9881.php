<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Detalhes do Registro #<?php echo e($registro->id); ?></h1>
    <p><strong>Planta:</strong> <?php echo e($registro->planta->nome_popular ?? 'N/A'); ?></p>
    <p><strong>Descrição:</strong> <?php echo e($registro->descricao); ?></p>
    <p><strong>Tipo:</strong> <?php echo e($registro->tipo); ?></p>
    <p><strong>Data:</strong> <?php echo e($registro->data->format('d/m/Y H:i')); ?></p>
    <p><strong>Latitude:</strong> <?php echo e($registro->lat); ?></p>
    <p><strong>Longitude:</strong> <?php echo e($registro->lon); ?></p>

    <div id="mapid" style="height: 400px;"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    var lat = <?php echo e($registro->lat ?? 0); ?>;
    var lon = <?php echo e($registro->lon ?? 0); ?>;

    var map = L.map('mapid').setView([lat || -23.550520, lon || -46.633308], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

    if(lat && lon){
        L.marker([lat, lon]).addTo(map)
            .bindPopup('Localização do Registro.')
            .openPopup();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_qr/resources/views/registros/show.blade.php ENDPATH**/ ?>