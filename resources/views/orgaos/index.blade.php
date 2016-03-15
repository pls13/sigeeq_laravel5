@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            @if (count($orgaos) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Cadastro de Órgãos/Secretarias
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped orgao-table">
                            <thead>
                                <th>Nome</th>
                                <th>Sigla</th>
                                <th>Ativo</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($orgaos as $orgao)
                                    <tr>
                                        <td class="table-text"><div>{{ $orgao->nome }}</div></td>
                                        <td class="table-text"><div>{{ $orgao->sigla }}</div></td>
                                        <td class="table-text"><div>{{ $orgao->active }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="/orgao/{{ $orgao->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-orgao-{{ $orgao->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
