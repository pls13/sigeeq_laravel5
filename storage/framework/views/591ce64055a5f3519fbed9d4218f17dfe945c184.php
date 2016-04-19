<?php $__env->startSection('content'); ?>

<div class="container">
    <?php if(Session::has('flash_success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('flash_success')); ?></div>
    <?php endif; ?>
    <div class="col-sm-offset-2 col-sm-8">

        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastro de Equipamentos - <?php echo e($unidade); ?>

                <a href="equipamentos/create" class="pull-right" id="lnk_adicionar"><i class="fa fa-fw fa-plus"></i>Adicionar</a>
            </div>
            <div class="panel-body">
                <?php if(count($equipamentos) > 0): ?>
                <table class="table table-striped equipamento-table" id="data-table">
                    <thead>
                    <th>Patrimônio</th>
                    <th>Tipo</th>
                    <th>Local</th>
                    <th>Unidade</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php foreach($equipamentos as $equipamento): ?>
                        <tr>
                            <td class="table-text" nowrap >
                                <a  href="<?php echo e(route('equipamentos.show', $equipamento->id)); ?>" >
                                    <i class="fa fa-btn fa-search-plus"></i><span id="patrimonio_<?php echo e($equipamento->id); ?>"><?php echo e($equipamento->patrimonio); ?></span>
                                </a>
                            </td>
                            <td class="table-text"><div><?php echo e($equipamento->tipo->nome); ?></div></td>
                            <td class="table-text"><div><?php echo e($equipamento->local->nome); ?></div></td>
                            <td class="table-text"><div><?php echo e($equipamento->unidade->sigla); ?></div></td>
                            <td nowrap class="table-text <?php echo e($equipamento->status->status->html_class); ?>">
                                <div>
                                    <a data-id="<?php echo e($equipamento->status->id); ?>" id="linkStatus_<?php echo e($equipamento->id); ?>"  data-toggle="modal" href="#modalStatus"  class="linkStatus <?php echo e($equipamento->status->status->html_class); ?>">
                                        <i class="fa fa-pencil fa-btn"></i><span id="lbStatus_<?php echo e($equipamento->id); ?>"><?php echo e($equipamento->status->status->nome); ?></span>
                                    </a>
                                </div>
                            </td>

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

    <!-- Modal STATUS -->
    <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar status do equipamento: <span id="nomeEquipamento"></span> - Status atual: <span id="stsEquipamento"></span></h5>
                </div>
                <form id="frmStatus" action="status/" method="POST" class="form-horizontal" >
                <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="equipamento-status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" id="equipamento-status" class="form-control" >
                                    <option value="">Selecione</option>
                                    <?php foreach($e_status as $status): ?>
                                    <option class="<?php echo e($status->html_class); ?>" value="<?php echo e($status->id); ?>"><?php echo e($status->nome); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-descricao" class="col-sm-3 control-label">Descrição</label>

                            <div class="col-sm-6">
                                <textarea name="descricao" id="equipamento-descricao" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit"id="submitStatus" class="btn btn-primary"><i class="fa fa-btn fa-check"></i>Gravar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#data-table').DataTable({
                "columnDefs": [{orderable: false, targets: [5, 6]}],
                "language":{"url":"<?php echo e(asset('DataTables/i18n/Portuguese-Brasil.json')); ?>" }});
           $('#data-table').on('click','.btn-delete', function () {
                if (!confirm('Confirma a exclusão?')) {
                    return false;
                }
            });
            $('#submitStatus').on('click', function () {
                $("#equipamento-descricao").val($.trim($("#equipamento-descricao").val()));
                if($("#equipamento-status").val() === ''){
                    alert('Selecione o status');
                    $().alert('close');
                    return false;
                }else if($("#equipamento-descricao").val() === ''){
                    alert('Descrição do status obrigatória');
                    return false;
                }else{
                    return true;
                }
            });
            $("#equipamento-status").change(function(){
                $(this).attr('class','form-control');
                $(this).addClass($(this).find('option:selected').attr('class'));
            });
            $('.no-delete-user').on('click', function () {
                alert("O usuário possui unidade vinculada e não pode ser excluído");
            });
            $("#lnk_adicionar").focus();
            $('#data-table').on('click', '.linkStatus', function(){
                var id = $(this).attr('id').replace('linkStatus_','');
                $("#frmStatus").attr('action',"status/"+$("#linkStatus_"+id).attr('data-id'));
                $("#equipamento-status").val('').change();
                $("#equipamento-descricao").val('');
                $("#nomeEquipamento").html($("#patrimonio_"+id).html());
                $("#stsEquipamento").html($("#lbStatus_"+id).html());
            });
            
            
        });
    </script>
    <?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>