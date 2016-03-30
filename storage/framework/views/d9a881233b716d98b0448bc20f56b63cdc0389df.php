<?php $__env->startSection('content'); ?>


<script>
    $(document).ready(function(){
        $('.btn-delete').on('click', function() {
             if(!confirm('Confirma a exclusão?')){
                 return false;
             }
        });
});
</script>
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
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <?php foreach($unidades as $unidade): ?>
                                    <tr>
                                        <td class="table-text"><div><?php echo e($unidade->nome); ?></div></td>
                                        <td class="table-text"><div><?php echo e($unidade->sigla); ?></div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="<?php echo e(route('unidades.edit', $unidade->id)); ?> "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <form action="/unidades/<?php echo e($unidade->id); ?>" method="POST" class="pull-left" >
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>


                                                <button type="submit" id="delete-unidade-<?php echo e($unidade->id); ?>" class="btn btn-danger btn-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
                                                
                                            </form>
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

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>