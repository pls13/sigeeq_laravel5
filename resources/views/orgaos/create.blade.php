@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Órgão/Secretaria
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="/orgaos" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="orgao-nome" class="col-sm-3 control-label">Nome</label>

                            <div class="col-sm-6">
                                <input type="text" name="nome" id="orgao-nome" class="form-control" value="{{ old('nome') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="orgao-sigla" class="col-sm-3 control-label">Sigla</label>

                            <div class="col-sm-6">
                                <input type="text" name="sigla" id="orgao-sigla" class="form-control" value="{{ old('sigla') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="orgao-active" class="col-sm-3 control-label">Ativo</label>
                            <div class="col-sm-2">
                                {{ Form::select('active', array('1' => 'Sim', '0' => 'Não'), old('active'), array('id'=>'orgao-active', 'class' => 'form-control')) }}
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Adicionar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
         </div>
    </div>
@endsection
