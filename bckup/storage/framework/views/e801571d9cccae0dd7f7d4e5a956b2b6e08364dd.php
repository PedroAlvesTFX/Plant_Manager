<!DOCTYPE html>
<html>
<head><title>Editor de Plantas</title></head>
<body>
    <h1>Show Planta editado</h1>
    <form action="/admin/planta" method="POST">
        <?php echo csrf_field(); ?>
        
        
        <input name="nome" placeholder="Nome" value=''><br>
        <input name="especie" placeholder="Espécie"><br>
        <input name="data_plantio" type="date"><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html><?php /**PATH /var/www/html/laravel_qr/resources/views/planta/show.blade.php ENDPATH**/ ?>