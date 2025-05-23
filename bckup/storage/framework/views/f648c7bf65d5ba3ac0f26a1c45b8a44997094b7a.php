<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Ativa</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><a href="/admin/planta/<?php echo e($planta->id); ?>/edit"><?php echo e($planta->id); ?></a></td>
                <td><?php echo e($planta->nome_popular); ?></a></td>
                <td><?php echo e($planta->e_panc ? 'Sim' : 'Não'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="2">Nenhuma planta encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/laravel_qr/resources/views/planta/tabela.blade.php ENDPATH**/ ?>