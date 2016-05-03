@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalhes do Equipamento
                    <a href="/equipamentos" class="pull-right" ><i class="fa fa-angle-double-left"></i></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <div class='form-horizontal'>
                        
                        <div class="form-group">
                            <label for="equipamento-tipo_id" class="col-sm-3 control-label">Tipo</label>
                            <div class="col-sm-6 detail-label">
                                {{ $equipamento->tipo->nome }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-patrimonio" class="col-sm-3 control-label">Nº Patrimônio</label>
                            <div class="col-sm-6 detail-label">
                                {{ $equipamento->patrimonio }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-observacao" class="col-sm-3 control-label">Observação</label>
                            <div class="col-sm-6 detail-label">
                                {!! nl2br(e($equipamento->observacao)) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-unidade_id" class="col-sm-3 control-label">Unidade</label>
                            <div class="col-sm-6 detail-label">
                                {{ $equipamento->unidade->nome }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="equipamento-local_id" class="col-sm-3 control-label">Local</label>
                            <div class="col-sm-6 detail-label" >
                                {{ $equipamento->local->nome }}
                            </div>
                        </div>
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Histórico de status
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped status-table">
                                        <thead>
                                            <th>Status</th>
                                            <th>Descricão</th>
                                            <th>Usuário</th>
                                            <th>Data</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($stsLog as $sts)
                                            <tr>
                                                <td class="table-text {{$sts->status->html_class}}"><div>{{ $sts->status->nome }}</div></td>
                                                <td class="table-text"><div>{{ $sts->descricao }}</div></td>
                                                <td class="table-text"><div>{{ $sts->user->name }}</div></td>
                                                <td class="table-text"><div>{{ $sts->created_at->format('d/m/Y') }}</div></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            
                        @if (Auth::user()->profile->name == 'Admin')
                        <div class=" col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Histórico de edição
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped status-table">
                                        <thead>
                                            <th>Patrimônio</th>
                                            <th>Tipo</th>
                                            <th>Unidade</th>
                                            <th>Local</th>
                                            <th>Observação</th>
                                            <th>Usuário</th>
                                            <th>Data</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($equipLog as $equip)
                                            <tr>
                                                <td class="table-text"><div>{{ $equip->patrimonio }}</div></td>
                                                <td class="table-text"><div>{{ ($equip->tipo instanceof App\TipoEquipamento)?$equip->tipo->nome:'N/D' }}</div></td>
                                                <td class="table-text"><div>{{ ($equip->unidade instanceof App\Unidade)?$equip->unidade->sigla:'N/D' }}</div></td>
                                                <td class="table-text"><div>{{ ($equip->local instanceof App\LocalEquipamento)?$equip->local->nome:'N/D' }}</div></td>
                                                <td class="table-text"><div>{{ $equip->observacao }}</div></td>
                                                <td class="table-text"><div>{{ ($equip->lastUser instanceof App\User)?$equip->lastUser->name:'removido' }}</div></td>
                                                <td class="table-text"><div>{{ $equip->created_at->format('d/m/Y') }}</div></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection
