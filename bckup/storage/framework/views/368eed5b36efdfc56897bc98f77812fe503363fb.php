<?php $__env->startSection('title', 'Lista de Plantas QR'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lista de Plantas QR lar</h1>
    <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('plantas.store')); ?>" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Nova Planta
        </a>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <form action="<?php echo e(route('plantas.index')); ?>" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar plantas..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>Nome Popular</th>
                <th>Espécie</th>
                <th>Mês Fruto</th>
                <th>Mês Flor</th>
                <th>Classificações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($planta->nome_popular); ?></td>
                <td><em><?php echo e($planta->especie); ?></em></td>
                <td>
                    <?php $__currentLoopData = $planta->frutos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fruto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-primary"><?php echo e($fruto->mes_frutos); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <?php $__currentLoopData = $planta->floracoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floracao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-primary"><?php echo e($floracao->mes_floracao); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <?php $__currentLoopData = $planta->classificacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classificacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-primary"><?php echo e($classificacao->classificacao); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('plantas.show', $planta)); ?>" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('plantas.judit', $planta)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('plantas.destroy', $planta)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4" class="text-center">Nenhuma planta encontrada</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    <?php echo e($plantas->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel_qr/resources/views/plantas/index.blade.php ENDPATH**/ ?>