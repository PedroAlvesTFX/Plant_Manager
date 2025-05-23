<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Editar Registro</h1>
    <form action="<?php echo e(route('registros.update', $registro->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('registros._form', ['registro' => $registro], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel_qr/resources/views/registros/edit.blade.php ENDPATH**/ ?>