@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Órgãos/Secretarias
                       <a href="orgaos/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                    @if (count($orgaos) > 0)
                        <table class="table table-striped orgao-table">
                            <thead>
                                <th>Nome</th>
                                <th>Sigla</th>
                                <th>Ativo</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($orgaos as $orgao)
                                    <tr>
                                        <td class="table-text"><div>{{ $orgao->nome }}</div></td>
                                        <td class="table-text"><div>{{ $orgao->sigla }}</div></td>
                                        <td class="table-text"><div>{{ $orgao->active?'Sim':'Não' }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="{{ route('orgaos.edit', $orgao->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            @if($orgao->canDelete())
                                            <form action="/orgaos/{{ $orgao->id }}" method="POST" class="pull-left" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-orgao-{{ $orgao->id }}" class="btn btn-danger btn-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
                                            </form>
                                             @else
                                                <button type="button" class="btn btn-no-delete">
                                                    <i class="fa fa-btn fa-trash"></i>Excluir
                                                </button>
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
        $('.btn-no-delete').on('click', function() {
             alert("Existe(m) unidade(s) associada(s) a esse registro");
        });
});
</script>
@endpush