<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1>Editar Planta</h1>

    <?php if(session('success')): ?>
        <div style="color: green;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('plantas.update', $planta->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label for="nome_popular">Nome da Planta:</label>
        <input type="text" id="nome_popular" name="nome_popular" value="<?php echo e(old('nome_popular', $planta->nome_popular)); ?>"><br>

        <label for="description">Nome Cientifico:</label>
        <textarea id="nome_cientifico" name="nome_cientifico"><?php echo e(old('nome_cientifico', $planta->nome_cientifico)); ?></textarea><br>

        <label for="e_panc">E Panc:</label>
        <input type="checkbox" id="e_panc" name="e_panc"   <?php echo e(old('e_panc', $planta->e_panc ?? false) ? 'checked' : ''); ?> >

        <label for="e_apicola">E Apicola:</label>
        <input type="checkbox" id="e_apicola" name="e_apicola"  <?php echo e(old('e_apicola', $planta->e_apicola ?? false) ? 'checked' : ''); ?> >

        <label for="e_forrageira">E forrageira:</label>
        <input type="checkbox" id="e_forrageira" name="e_forrageira"  <?php echo e(old('e_forrageira', $planta->e_forrageira ?? false) ? 'checked' : ''); ?> >


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

<form action="<?php echo e(route('plantas.destroy', $planta->id)); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta planta, <?php echo e($planta->nome_popular); ?> ?');">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger">Deletar</button>
</form>
</div>
   <?php echo e($planta->id); ?> <?php echo e($planta->name); ?>

    <br>
    <a href="<?php echo e(url('/plantas')); ?>"> Voltar à lista</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_qr/resources/views/plantas/edit.blade.php ENDPATH**/ ?>