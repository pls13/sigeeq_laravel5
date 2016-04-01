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
                        <table class="table table-striped user-table">
                            <thead>
                                <th>Nome</th>
                                <th>E-Mail</th>
                                <th>Perfil</th>
                                <th>Ativo</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-text"><div>{{ $user->name }}</div></td>
                                        <td class="table-text"><div>{{ $user->email }}</div></td>
                                        <td class="table-text"><div>{{ $user->profile->name }}</div></td>
                                        <td class="table-text"><div>{{ (($user->unidade)?$user->unidade->nome:'N/D') }}</div></td>
                                        <td class="table-text"><div>{{ $user->active?'Sim':'Não' }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="{{ route('users.edit', $user->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            @if($user->unidade)
                                            <button type="button" id="no-delete-user-{{ $user->id }}" class="btn btn-danger no-delete-user">
                                                <i class="fa fa-btn fa-trash"></i>Excluir
                                            </button>
                                            @else
                                            <form action="/users/{{ $user->id }}" method="POST" class="pull-left" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger btn-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
                                            </form>
                                            @endif
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
<script>
    $(document).ready(function(){
        $('.btn-delete').on('click', function() {
             if(!confirm('Confirma a exclusão?')){
                 return false;
             }
        });
        $('.no-delete-user').on('click', function() {
             alert("O usuário possui unidade vinculada e não pode ser excluído");
        });
});
</script>
@endpush
