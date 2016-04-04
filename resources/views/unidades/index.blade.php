@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Unidades
                       <a href="unidades/create" class="pull-right" ><i class="fa fa-fw fa-plus"></i>Adicionar</a>
                    </div>
                    <div class="panel-body">
                         @if (count($unidades) > 0)
                        <table class="table table-striped unidade-table">
                            <thead>
                                <th>Nome</th>
                                <th>Sigla</th>
                                <th>Órgão/ Secretaria</th>
                                <th>Responsável TI</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($unidades as $unidade)
                                    <tr>
                                        <td class="table-text"><div>{{ $unidade->nome }}</div></td>
                                        <td class="table-text"><div>{{ $unidade->sigla }}</div></td>
                                        <td class="table-text"><div>{{ $unidade->orgao->sigla }}</div></td>
                                        <td class="table-text"><div>{{ (($unidade->tecnico instanceof App\User)?$unidade->tecnico->name:'N/D') }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <a class="btn btn-small btn-info pull-left " href="{{ route('unidades.edit', $unidade->id) }} "><i class="fa fa-pencil fa-btn"></i>Editar</a>
                                        </td>
                                        <td>
                                            @if($unidade->canDelete())
                                            <form action="/unidades/{{ $unidade->id }}" method="POST" class="pull-left" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" id="delete-unidade-{{ $unidade->id }}" class="btn btn-danger btn-delete">
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
                         <div>Não há unidades cadastradas</div>
                         @endif
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
             alert("Essa unidade não pode mais ser excluída pois há registros de equipamentos associados a ela.");
        });
});
</script>
@endpush