<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Novo Registro</h1>
    <form action="<?php echo e(route('registros.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('registros._form', ['registro' => null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_qr/resources/views/registros/create.blade.php ENDPATH**/ ?>