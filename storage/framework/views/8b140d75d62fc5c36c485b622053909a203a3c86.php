<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nova Unidade
                    <a href="/unidades" class="pull-right" ><i class="fa fa-angle-double-left"></i></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <!--Form -->
                    <form action="/unidades" method="POST" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        
                        <div class="form-group">
                            <label for="unidade-orgao_id" class="col-sm-3 control-label">Órgão</label>
                            <div class="col-sm-6">
                                <?php echo e(Form::select('orgao_id', $orgaos, old('orgao_id'), array('id'=>'unidade-orgao_id', 'class' => 'form-control', 'placeholder'=>'Selecione'))); ?>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="unidade-nome" class="col-sm-3 control-label">Nome</label>

                            <div class="col-sm-6">
                                <input type="text" name="nome" id="unidade-nome" class="form-control" value="<?php echo e(old('nome')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-sigla" class="col-sm-3 control-label">Sigla</label>

                            <div class="col-sm-6">
                                <input type="text" name="sigla" id="unidade-sigla" class="form-control" value="<?php echo e(old('sigla')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-rua" class="col-sm-3 control-label">Logradouro</label>

                            <div class="col-sm-6">
                                <input type="text" name="rua" id="unidade-rua" class="form-control" value="<?php echo e(old('rua')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-numero" class="col-sm-3 control-label">Número</label>
                            <div class="col-sm-6">
                                <input type="text" name="numero" id="unidade-numero" class="form-control" value="<?php echo e(old('numero')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-bairro" class="col-sm-3 control-label">Bairro</label>
                            <div class="col-sm-6">
                                <input type="text" name="bairro" id="unidade-bairro" class="form-control" value="<?php echo e(old('bairro')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-telefone" class="col-sm-3 control-label">Telefone</label>
                            <div class="col-sm-6">
                                <input type="text" name="telefone" id="unidade-telefone" class="form-control" value="<?php echo e(old('telefone')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-nome_diretor" class="col-sm-3 control-label">Responsável/Diretor</label>
                            <div class="col-sm-6">
                                <input type="text" name="nome_diretor" id="unidade-nome_diretor" class="form-control" value="<?php echo e(old('nome_diretor')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidade-tecnico_id" class="col-sm-3 control-label">Responsável TI</label>
                            <div class="col-sm-6">
                                <?php echo e(Form::select('tecnico_id', $users, old('tecnico_id'), array('id'=>'unidade-tecnico_id', 'class' => 'form-control', 'placeholder'=>'Selecione'))); ?>

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