<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Cadastrar Planta</h1>

    <?php if(session('success')): ?>
        <div style="color: green;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('plantas.store', $planta->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>

        <label for="nome_popular">Nome da Planta:</label>
        <input type="text" id="nome_popular" name="nome_popular" value="<?php echo e(old('nome_popular', $planta->nome_popular)); ?>"><br>

        <label for="description">Nome Cientifico:</label>
        <textarea id="nome_cientifico" name="nome_cientifico"></textarea><br>

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
    <a href="<?php echo e(url('/plantas')); ?>"> Voltar à lista</a>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel_qr/resources/views/plantas/show.blade.php ENDPATH**/ ?>