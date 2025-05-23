<?php $__env->startSection('content'); ?>
    <h1>Nova Planta editado</h1>
    <form action="/admin/planta" method="POST">
        <?php echo csrf_field(); ?>
        <input name="nome_popular"    placeholder="nome_popular">   <br>
        <input name="nome_cientifico" placeholder="nome_cientifico"><br>
        <label for="e_panc">E Panc:</label>
        <input type="checkbox" id="e_panc" name="e_panc"  >

        <label for="e_apicola">E Apicola:</label>
        <input type="checkbox" id="e_apicola" name="e_apicola"  >

        <label for="e_forrageira">E forrageira:</label>
        <input type="checkbox" id="e_forrageira" name="e_forrageira" >

        <button type="submit">Cadastrar</button>
    </form>

<!-- Exemplo de mensagens no layout -->
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>


    <h2>Plantas Cadastradas</h2>

    <input type="text" id="campo-busca" placeholder="Buscar por nome...">

    <div id="tabela-plantas">
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const campoBusca = document.getElementById('campo-busca');
            const tabelaContainer = document.getElementById('tabela-plantas');

            function buscarPlantas() {
                const termo = campoBusca.value;

                fetch(`/plantas/buscar?busca=${encodeURIComponent(termo)}`)
                    .then(response => response.text())
                    .then(html => {
                        tabelaContainer.innerHTML = html;
//                       alert('ok');
                    });
            }

            // Buscar automaticamente ao digitar (com pequeno atraso)
            let timer;
            campoBusca.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(buscarPlantas, 300);
            });

            // Carregar tabela inicialmente
            buscarPlantas();
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel_qr/resources/views/plantas/create.blade.php ENDPATH**/ ?>