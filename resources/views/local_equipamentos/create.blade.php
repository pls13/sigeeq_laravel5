@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Local de Equipamento
                    <a href="/local_equipamentos" class="pull-right" ><i class="fa fa-angle-double-left"></i></i> Voltar</a>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="/local_equipamentos" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="local_equipamento-nome" class="col-sm-3 control-label">Nome</label>

                            <div class="col-sm-6">
                                <input type="text" name="nome" id="local_equipamento-nome" class="form-control" value="{{ old('nome') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="local_equipamento-descricao" class="col-sm-3 control-label">Descrição</label>

                            <div class="col-sm-6">
                                <textarea name="descricao" id="local_equipamento-descricao" class="form-control" >{{ old('descricao') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="local_equipamento-active" class="col-sm-3 control-label">Ativo</label>
                            <div class="col-sm-2">
                                {{ Form::select('active', array('1' => 'Sim', '0' => 'Não'), old('active'), array('id'=>'local_equipamento-active', 'class' => 'form-control')) }}
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
