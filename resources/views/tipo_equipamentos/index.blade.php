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
                       Cadastro de Tipo de Equipamento
                       <a href="tipo_equipamentos/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                        @if (count($tipo_equipamentos) > 0)
                        <table class="table table-striped tipo_equipamento-table">
                            <thead>
                                <th>Nome</th>
                                <th>Ativo</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tipo_equipamentos as $tipo_equipamento)
                                    <tr>
                                        <td class="table-text"><div>{{ $tipo_equipamento->nome }}</div></td>
                                        <td class="table-text"><div>{{ $tipo_equipamento->active?'Sim':'Não' }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="{{ route('tipo_equipamentos.edit', $tipo_equipamento->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            <form action="/tipo_equipamentos/{{ $tipo_equipamento->id }}" method="POST" class="pull-left" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-tipo_equipamento-{{ $tipo_equipamento->id }}" class="btn btn-danger btn-delete">
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
