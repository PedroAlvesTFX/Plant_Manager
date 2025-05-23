<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Editar Planta</h1>

    <?php if(session('success')): ?>
        <div style="color: green;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('plantas.update', $planta->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label for="nome">Nome da Planta:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo e(old('nome', $planta->nome)); ?>"><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao"><?php echo e(old('descricao', $planta->descricao)); ?></textarea><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
   <?php echo e($planta->id); ?> <?php echo e($planta->nome); ?>

    <br>
    <a href="<?php echo e(url('/admin/planta')); ?>">� Voltar à lista</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_qr/resources/views/planta/editar.blade.php ENDPATH**/ ?>