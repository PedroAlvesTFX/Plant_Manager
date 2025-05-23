<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Registros</h1>
    <a href="<?php echo e(route('registros.create')); ?>" class="btn btn-primary mb-3">Novo Registro</a>

    <?php if($registros->count()): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Planta</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($registro->id); ?></td>
                    <td><?php echo e($registro->planta->nome_popular ?? 'N/A'); ?></td>
                    <td><?php echo e($registro->descricao); ?></td>
                    <td><?php echo e($registro->tipo); ?></td>
                    <td><?php echo e($registro->data->format('d/m/Y H:i')); ?></td>
                    <td>
                        <a href="<?php echo e(route('registros.show', $registro->id)); ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="<?php echo e(route('registros.edit', $registro->id)); ?>" class="btn btn-sm btn-warning">Editar</a>
                        <form action="<?php echo e(route('registros.destroy', $registro->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Confirma a exclusão?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($registros->links()); ?>

    <?php else: ?>
        <p>Nenhum registro encontrado.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel_qr/resources/views/registros/index.blade.php ENDPATH**/ ?>