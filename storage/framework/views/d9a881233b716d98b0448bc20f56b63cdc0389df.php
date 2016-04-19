<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Unidades
                       <a href="unidades/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                         <?php if(count($unidades) > 0): ?>
                        <table class="table table-striped unidade-table">
                            <thead>
                                <th>Nome</th>
                                <th>Sigla</th>
                                <th>Órgão/ Secretaria</th>
                                <th>Responsável TI</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <?php foreach($unidades as $unidade): ?>
                                    <tr>
                                        <td class="table-text"><div><?php echo e($unidade->nome); ?></div></td>
                                        <td class="table-text"><div><?php echo e($unidade->sigla); ?></div></td>
                                        <td class="table-text"><div><?php echo e($unidade->orgao->sigla); ?></div></td>
                                        <td class="table-text"><div><?php echo e((($unidade->tecnico instanceof App\User)?$unidade->tecnico->name:'N/D')); ?></div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="<?php echo e(route('unidades.edit', $unidade->id)); ?> "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <?php if($unidade->canDelete()): ?>
                                            <form action="/unidades/<?php echo e($unidade->id); ?>" method="POST" class="pull-left" >
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>

                                                <button type="submit" id="delete-unidade-<?php echo e($unidade->id); ?>" class="btn btn-danger btn-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
                                            </form>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-no-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                         <?php else: ?>
                         <div>Não há unidades cadastradas</div>
                         <?php endif; ?>
                </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        $('.btn-delete').on('click', function() {
             if(!confirm('Confirma a exclusão?')){
                 return false;
             }
        });
            $('.btn-no-delete').on('click', function() {
             alert("Essa unidade não pode mais ser excluída pois há registros de equipamentos associados a ela.");
        });
});
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>