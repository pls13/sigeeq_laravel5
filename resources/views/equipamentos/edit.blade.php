@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edição - Equipamento
                    <a href="/equipamentos" class="pull-right" ><i class="fa fa-angle-double-left"></i></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!--Form -->
                    {{ Form::model($equipamento, array('route' => array('equipamentos.update', $equipamento->id), 'method' => 'PUT', 'class'=>'form-horizontal')) }}
                        <div class="form-group">
                            <label for="equipamento-unidade_id" class="col-sm-3 control-label">Unidade</label>
                            <div class="col-sm-6">
                                {{ Form::select('unidade_id', $unidades, $equipamento->unidade_id, array('id'=>'equipamento-unidade_id', 'class' => 'form-control', 'placeholder'=>'Selecione')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="equipamento-local_id" class="col-sm-3 control-label">Local</label>
                            <div class="col-sm-6">
                                {{ Form::select('local_id', $locais,$equipamento->local_id, array('id'=>'equipamento-local_id', 'class' => 'form-control', 'placeholder'=>'Selecione')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-tipo_id" class="col-sm-3 control-label">Tipo</label>
                            <div class="col-sm-6">
                                {{ Form::select('tipo_id', $tipos, $equipamento->tipo_id, array('id'=>'equipamento-tipo_id', 'class' => 'form-control', 'placeholder'=>'Selecione')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-patrimonio" class="col-sm-3 control-label">Nº Patrimônio</label>

                            <div class="col-sm-6">
                                <input type="text" name="patrimonio" id="equipamento-patrimonio" class="form-control" value="{{ $equipamento->patrimonio }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-observacao" class="col-sm-3 control-label">Observação</label>

                            <div class="col-sm-6">
                                <textarea name="observacao" id="equipamento-observacao" class="form-control" >{{ $equipamento->observacao }}</textarea>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-check"></i>Gravar Alterações
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
         </div>
    </div>
@endsection
