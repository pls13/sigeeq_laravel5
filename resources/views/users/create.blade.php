
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Novo Usuário
                <a href="/users" class="pull-right" ><i class="fa fa-angle-double-left"></i> Voltar</a>
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->

                <form action="/users" method="POST" class="form-horizontal">

                {{ csrf_field() }}

                <!-- Task Name -->
                <div class="form-group">
                    <label for="user-name" class="col-sm-3 control-label">Nome</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="user-name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-username" class="col-sm-3 control-label">Usename</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" id="user-username" class="form-control" value="{{ old('username') }}">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">E-Mail</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
      
                <div class="form-group">
                    <label for="user-unidade_id" class="col-sm-3 control-label">Unidade alocado</label>
                    <div class="col-sm-6">
                        {{ Form::select('unidade_id', $unidades, old('unidade_id'), array('id'=>'user-unidade_id', 'class' => 'form-control',  'placeholder'=>'Nenhuma')) }}
                    </div>
                </div>                        
                <div class="form-group">
                    <label for="user-profile_id" class="col-sm-3 control-label">Perfil</label>
                    <div class="col-sm-2">
                        {{ Form::select('profile_id', $profiles, (old('profile_id')?old('profile_id'):2), array('id'=>'user-profile_id', 'class' => 'form-control')) }}
                    </div>
                </div>                        

                <div class="form-group">
                    <label for="user-active" class="col-sm-3 control-label">Ativo</label>
                    <div class="col-sm-2">
                        {{ Form::select('active', array('1' => 'Sim', '0' => 'Não'), old('active'), array('id'=>'user-active', 'class' => 'form-control')) }}
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
