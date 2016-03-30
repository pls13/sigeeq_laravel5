@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edição - Local de Equipamento 
                    <a href="/local_equipamentos" class="pull-right" ><i class="fa fa-angle-double-left"></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    
                        {{ Form::model($local_equipamento, array('route' => array('local_equipamentos.update', $local_equipamento->id), 'method' => 'PUT', 'class'=>'form-horizontal')) }}

                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="local_equipamento-nome" class="col-sm-3 control-label">Nome</label>

                            <div class="col-sm-6">
                                <input type="text" name="nome" id="local_equipamento-nome" class="form-control" value="{{ $local_equipamento->nome }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="local_equipamento-descricao" class="col-sm-3 control-label">Descrição</label>

                            <div class="col-sm-6">
                                <textarea name="descricao" id="local_equipamento-descricao" class="form-control">{{ $local_equipamento->descricao }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="local_equipamento-active" class="col-sm-3 control-label">Ativo</label>
                            <div class="col-sm-2">
                                {{ Form::select('active', array('1' => 'Sim', '0' => 'Não'), $local_equipamento->active, array('id'=>'local_equipamento-active', 'class' => 'form-control')) }}
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
