@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Equipamento
                    <a href="/equipamentos" class="pull-right" ><i class="fa fa-angle-double-left"></i></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!--Form -->
                    <form action="/equipamentos" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="equipamento-unidade_id" class="col-sm-3 control-label">Unidade</label>
                            <div class="col-sm-6">
                                {{ Form::select('unidade_id', $unidades, old('unidade_id'), array('id'=>'equipamento-unidade_id', 'class' => 'form-control', 'placeholder'=>'Selecione')) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="equipamento-local_id" class="col-sm-3 control-label">Local</label>
                            <div class="col-sm-6">
                                {{ Form::select('local_id', $locais, old('local_id'), array('id'=>'equipamento-local_id', 'class' => 'form-control', 'placeholder'=>'Selecione')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-tipo_id" class="col-sm-3 control-label">Tipo</label>
                            <div class="col-sm-6">
                                {{ Form::select('tipo_id', $tipos, old('tipo_id'), array('id'=>'equipamento-tipo_id', 'class' => 'form-control', 'placeholder'=>'Selecione')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-patrimonio" class="col-sm-3 control-label">Nº Patrimônio</label>

                            <div class="col-sm-6">
                                <input type="text" name="patrimonio" id="equipamento-patrimonio" class="form-control" value="{{ old('patrimonio') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-observacao" class="col-sm-3 control-label">Observação</label>

                            <div class="col-sm-6">
                                <textarea name="observacao" id="equipamento-observacao" class="form-control" >{{ old('observacao') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipamento-active" class="col-sm-3 control-label">Ativo</label>
                            <div class="col-sm-2">
                                {{ Form::select('active', array('1' => 'Sim', '0' => 'Não'), old('active'), array('id'=>'equipamento-active', 'class' => 'form-control')) }}
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
@endsection
