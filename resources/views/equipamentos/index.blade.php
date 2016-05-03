@extends('layouts.app')

@section('content')

<div class="container">
    @if(Session::has('flash_success'))
    <div class="alert alert-success">{{ Session::get('flash_success') }}</div>
    @endif
    <div class="col-sm-offset-2 col-sm-8">

        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastro de Equipamentos - {{ $unidade }}
                <a href="equipamentos/create" class="pull-right" id="lnk_adicionar"><i class="fa fa-fw fa-plus"></i>Adicionar</a>
            </div>
            <div class="panel-body">
                @if (count($equipamentos) > 0)
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
                        @foreach ($equipamentos as $equipamento)
                        <tr>
                            <td class="table-text" nowrap >
                                <a  href="{{ route('equipamentos.show', $equipamento->id) }}" >
                                    <i class="fa fa-btn fa-search-plus"></i><span id="patrimonio_{{ $equipamento->id }}">{{ $equipamento->patrimonio }}</span>
                                </a>
                            </td>
                            <td class="table-text"><div>{{ $equipamento->tipo->nome }}</div></td>
                            <td class="table-text"><div>{{ $equipamento->local->nome }}</div></td>
                            <td class="table-text"><div>{{ $equipamento->unidade->sigla }}</div></td>
                            <td class="table-text {{ $e_status[$equipamento->status->status_id]->html_class }}">
                                <div>
                                    <a data-id="{{ $equipamento->status->id }}" id="linkStatus_{{ $equipamento->id }}"  data-toggle="modal" href="#modalStatus"  class="linkStatus {{ $e_status[$equipamento->status->status_id]->html_class }}">
                                        <i class="fa fa-pencil fa-btn"></i><span id="lbStatus_{{ $equipamento->id }}">{{ $e_status[$equipamento->status->status_id]->nome }}</span>
                                    </a>
                                </div>
                            </td>

                            <!-- Task Delete Button -->
                            <td>
                                <a class="btn btn-small btn-info pull-left " href="{{ route('equipamentos.edit', $equipamento->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                            </td>
                            <td>
                                <form action="/equipamentos/{{ $equipamento->id }}" method="POST" class="pull-left" >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-equipamento-{{ $equipamento->id }}" class="btn btn-danger btn-delete">
                                        <i class="fa fa-btn fa-trash"></i>Excluir
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div>Não há registros</div>
                @endif
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
                {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="equipamento-status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" id="equipamento-status" class="form-control" >
                                    <option value="">Selecione</option>
                                    @foreach($e_status as $status)
                                    <option class="{{ $status->html_class }}" value="{{ $status->id }}">{{ $status->nome }}</option>
                                    @endforeach
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
    
    
    @endsection
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#data-table').DataTable({
                "columnDefs": [{orderable: false, targets: [5, 6]}],
                "language":{"url":"{{ asset('DataTables/i18n/Portuguese-Brasil.json') }}" }});
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
    @endpush