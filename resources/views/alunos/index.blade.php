@extends('layouts.app')

@section('content')
    <a href="{{ route('alunos.create') }}" class="btn btn-warning btn-sm btn-add btn-floating">
        <i class="fas fa-plus-circle"></i>
    </a>
    <div class="container-fluid">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">alunos</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title mb-0 text-white">
                        Lista de alunos cadastradas
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data. Nasc</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($alunos as $aluno)
                            <tr>
                                <td>{{ $aluno->nome }}</td>
                                <td>{{ $aluno->data_nasc }}</td>
                                <td>{{ $aluno->cpf }}</td>
                                <td>{{ $aluno->email }}</td>
                                <td>{{ $aluno->celular }}</td>
                                <td>{{ $aluno->status == 1 ? "Ativo" : "Inativo" }}</td>
                                <td>
                                    <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $aluno->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Não existem alunos cadastrados!</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">{{ $alunos->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($alunos as $aluno)

{{--        @include('parts.modal.instituicao_modal', ['instituicao'=> $aluno->instituicao, 'curso' => $aluno->id])--}}

        <div class="modal fade" id="deleteModal{{ $aluno->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-md" role="document">
                <form action="{{ route('alunos.destroy', [$aluno]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title w-100 text-center" id="modalExcluirLabel{{ $aluno->id }}">Excluir curso {{ $aluno->nome }}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Deseja excluir este aluno?</h4>
                            <p class="text-danger"><sup>*</sup>Uma vez excluido, não poderá ser recuperado.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-success btn-sm">Sim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@stop
