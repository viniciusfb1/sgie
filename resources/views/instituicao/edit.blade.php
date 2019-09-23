@extends('layouts.app')

@section('scripts')
    <script>
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    </script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('instituicoes.index') }}">Instituições</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                @include('formularios.instituicao', ['instituicao' => $instituicao])
            </div>
            <div class="col-12 col-lg-5">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="card-title mb-0 text-white">
                            Lista de cursos da instituicao {{ $instituicao->nome }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableList">
                            <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instituicao->cursos as $key => $curso)
                                <tr>
                                    <td>{{ $curso->nome }}</td>
                                    <td>{{ $curso->status == 1 ? 'Ativo' : 'Inativo' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#addInstituicao{{ $instituicao->id }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('parts.modal.vincular-instituicao', ['instituicao' => $instituicao])
@stop
