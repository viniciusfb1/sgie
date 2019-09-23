@extends('layouts.app')

@section('content')
    <a href="{{ route('cursos.create') }}" class="btn btn-warning btn-sm btn-add btn-floating">
        <i class="fas fa-plus-circle"></i>
    </a>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cursos</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title mb-0 text-white">
                        Lista de cursos cadastradas
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Duração</th>
                            <th>Instituições</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $curso->nome }}</td>
                                <td>{{ $curso->duracao }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInstituicao{{ $curso->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $curso->status == 1 ? "Ativo" : "Inativo" }}</td>
                                <td>
                                    <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $curso->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Não existem cursos cadastrados!</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{{ $cursos->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($cursos as $curso)

        @include('parts.modal.instituicao_modal', ['instituicao'=> $curso->instituicao, 'curso' => $curso->id])

        <div class="modal fade" id="deleteModal{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <!-- Change class .modal-sm to change the size of the modal -->
            <div class="modal-dialog modal-md" role="document">
                <form action="{{ route('cursos.destroy', [$curso]) }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title w-100 text-center" id="modalExcluirLabel{{ $curso->id }}">Excluir curso {{ $curso->nome }}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Deseja excluir este curso?</h4>
                            <p class="text-danger"><sup>*</sup>Uma vez excluida, não poderá ser recuperada.</p>
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
