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
                       Cadastro de Usuários
                       <a href="users/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                    <?php if(count($users) > 0): ?>
                        <table class="table table-striped user-table">
                            <thead>
                                <th>Nome</th>
                                <th>E-Mail</th>
                                <th>Perfil</th>
                                <th>Ativo</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td class="table-text"><div><?php echo e($user->name); ?></div></td>
                                        <td class="table-text"><div><?php echo e($user->email); ?></div></td>
                                        <td class="table-text"><div><?php echo e($user->profile->name); ?></div></td>
                                        <td class="table-text"><div><?php echo e($user->active?'Sim':'Não'); ?></div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="<?php echo e(route('users.edit', $user->id)); ?> "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <form action="/users/<?php echo e($user->id); ?>" method="POST" class="pull-left" >
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>


                                                <button type="submit" id="delete-user-<?php echo e($user->id); ?>" class="btn btn-danger btn-delete">
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>