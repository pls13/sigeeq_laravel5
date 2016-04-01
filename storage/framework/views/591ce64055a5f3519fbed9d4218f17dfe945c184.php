<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Equipamentos - <?php echo e($unidade); ?>

                       <a href="equipamentos/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                         <?php if(count($equipamentos) > 0): ?>
                        <table class="table table-striped equipamento-table">
                            <thead>
                                <th>Patrimônio</th>
                                <th>Tipo</th>
                                <th>Local</th>
                                <th>Unidade</th>
                                <th>Última Edição</th>
                            </thead>
                            <tbody>
                                <?php foreach($equipamentos as $equipamento): ?>
                                    <tr>
                                        <td class="table-text"><div><?php echo e($equipamento->patrimonio); ?></div></td>
                                        <td class="table-text"><div><?php echo e($equipamento->tipo->nome); ?></div></td>
                                        <td class="table-text"><div><?php echo e($equipamento->local->nome); ?></div></td>
                                        <td class="table-text"><div><?php echo e($equipamento->unidade->sigla); ?></div></td>
                                        <td class="table-text"><div><?php echo e($equipamento->lastUser->name); ?></div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="<?php echo e(route('equipamentos.edit', $equipamento->id)); ?> "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <form action="/equipamentos/<?php echo e($equipamento->id); ?>" method="POST" class="pull-left" >
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>


                                                <button type="submit" id="delete-equipamento-<?php echo e($equipamento->id); ?>" class="btn btn-danger btn-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
                                                
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                         <?php else: ?>
                         <div>Não há registros</div>
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
        $('.no-delete-user').on('click', function() {
             alert("O usuário possui unidade vinculada e não pode ser excluído");
        });
});
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>