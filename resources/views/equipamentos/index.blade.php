@extends('layouts.app')

@section('content')


<script>
    $(document).ready(function(){
        $('.btn-delete').on('click', function() {
             if(!confirm('Confirma a exclusão?')){
                 return false;
             }
        });
});
</script>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Equipamentos
                       <a href="equipamentos/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                         @if (count($equipamentos) > 0)
                        <table class="table table-striped equipamento-table">
                            <thead>
                                <th>Patrimônio</th>
                                <th>Tipo</th>
                                <th>Local</th>
                                <th>Unidade</th>
                                <th>Última Edição</th>
                            </thead>
                            <tbody>
                                @foreach ($equipamentos as $equipamento)
                                    <tr>
                                        <td class="table-text"><div>{{ $equipamento->patrimonio }}</div></td>
                                        <td class="table-text"><div>{{ $equipamento->tipo->nome }}</div></td>
                                        <td class="table-text"><div>{{ $equipamento->local->nome }}</div></td>
                                        <td class="table-text"><div>{{ $equipamento->unidade->sigla }}</div></td>
                                        <td class="table-text"><div>{{ $equipamento->lastUser->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="{{ route('equipamentos.edit', $equipamento->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <form action="/equipamentos/{{ $equipamento->id }}" method="POST" class="pull-left" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-equipamento-{{ $equipamento->id }}" class="btn btn-danger btn-delete">
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
@endsection
