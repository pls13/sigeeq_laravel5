<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Novo Usuário
                <a href="/users" class="pull-right" ><i class="fa fa-angle-double-left"></i> Voltar</a>
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- New Task Form -->

                <form action="/users" method="POST" class="form-horizontal">

                <?php echo e(csrf_field()); ?>


                <!-- Task Name -->
                <div class="form-group">
                    <label for="user-name" class="col-sm-3 control-label">Nome</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="user-name" class="form-control" value="<?php echo e(old('name')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-username" class="col-sm-3 control-label">Usename</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" id="user-username" class="form-control" value="<?php echo e(old('username')); ?>">
                    </div>
                </div>
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label class="col-md-3 control-label">E-Mail</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

                        <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
      
                <div class="form-group">
                    <label for="user-unidade_id" class="col-sm-3 control-label">Unidade alocado</label>
                    <div class="col-sm-6">
                        <?php echo e(Form::select('unidade_id', $unidades, old('unidade_id'), array('id'=>'user-unidade_id', 'class' => 'form-control',  'placeholder'=>'Nenhuma'))); ?>

                    </div>
                </div>                        
                <div class="form-group">
                    <label for="user-profile_id" class="col-sm-3 control-label">Perfil</label>
                    <div class="col-sm-2">
                        <?php echo e(Form::select('profile_id', $profiles, (old('profile_id')?old('profile_id'):2), array('id'=>'user-profile_id', 'class' => 'form-control'))); ?>

                    </div>
                </div>                        

                <div class="form-group">
                    <label for="user-active" class="col-sm-3 control-label">Ativo</label>
                    <div class="col-sm-2">
                        <?php echo e(Form::select('active', array('1' => 'Sim', '0' => 'Não'), old('active'), array('id'=>'user-active', 'class' => 'form-control'))); ?>

                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-check"></i>Adicionar
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>