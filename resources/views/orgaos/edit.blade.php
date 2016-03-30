@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edição - Órgão/Secretaria 
                    <a href="/orgaos" class="pull-right" ><i class="fa fa-angle-double-left"></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    
                        {{ Form::model($orgao, array('route' => array('orgaos.update', $orgao->id), 'method' => 'PUT', 'class'=>'form-horizontal')) }}

                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="orgao-nome" class="col-sm-3 control-label">Nome</label>

                            <div class="col-sm-6">
                                <input type="text" name="nome" id="orgao-nome" class="form-control" value="{{ $orgao->nome }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="orgao-sigla" class="col-sm-3 control-label">Sigla</label>

                            <div class="col-sm-6">
                                <input type="text" name="sigla" id="orgao-sigla" class="form-control" value="{{ $orgao->sigla }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="orgao-active" class="col-sm-3 control-label">Ativo</label>
                            <div class="col-sm-2">
                                {{ Form::select('active', array('1' => 'Sim', '0' => 'Não'), $orgao->active, array('id'=>'orgao-active', 'class' => 'form-control')) }}
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
