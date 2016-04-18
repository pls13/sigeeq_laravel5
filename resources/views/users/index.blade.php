@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Usuários
                       <a href="users/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                    @if (count($users) > 0)
                    <table class="table table-striped user-table" id="data-table">
                            <thead>
                                <th>Nome</th>
                                <th>Perfil</th>
                                <th>Unidade Alocado</th>
                                <th>Ativo</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-text"><div>{{ $user->name }}</div></td>
                                        <td class="table-text"><div>{{ $user->profile->name }}</div></td>
                                        <td class="table-text"><div>{{ (($user->unidade)?$user->unidade->sigla:'N/D') }}</div></td>
                                        <td class="table-text"><div>{{ $user->active?'Sim':'Não' }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="{{ route('users.edit', $user->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <form action="/users/{{ $user->id }}" method="POST" class="pull-left" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger btn-delete">
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
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $('.btn-delete').on('click', function() {
         if(!confirm('Confirma a exclusão?')){
             return false;
         }
    });
});
</script>
@endpush
