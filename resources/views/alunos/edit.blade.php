@extends('layouts.app')

@section('scripts')
    <script>
        $(document).ready(function() {

        });

        $('#cpf').mask('000.000.000-00');
        $('#celular').mask('(00) 0 0000-0000');
        $('#cep').mask('00000-000');

        $('#instituicao').on('change', function(){
            let _val = $(this).val();
            let _url = "{{ route("instituicoes.show", '') }}/"+_val;

            if(_val != '') {
                $.ajax({
                    type: 'GET',
                    data: {'id' : _val},
                    url: _url,
                    beforeSend: function(xhr) {
                        let _html = "<option value=''>...</option>";
                        $('#curso').html(_html);
                    },
                    success: function(resp) {
                        let _html = "<option value=''>Selecione</option>";
                        if(resp.length > 0) {
                            $.each(resp, function(k, v) {
                                _html += "<option value='"+v.id+"'>"+v.nome+"</option>";

                            });
                            $('#curso').html(_html);
                        }
                    },
                    error: function(error) {

                    }
                });
            } else {
                let _html = "<option value=''>Selecione</option>";
                $('#curso').html(_html);
            }
        });
    </script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('alunos.index') }}">Alunos</a></li>
                    <li class="breadcrumb-item active">Cadastrar</li>
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
                @include('formularios.aluno', ['aluno' => $aluno])
            </div>
            <div class="col-12 col-lg-5">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="card-title mb-0 text-white">
                            Lista de cursos matriculados
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableList">
                            <thead>
                            <tr>
                                <th>Instituição</th>
                                <th>Curso</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($aluno->instituicao as $key => $instituicao)
                                <tr>
                                    <td>{{ $instituicao->nome }}</td>
                                    <td>{{ $aluno->curso[$key]->nome }}</td>
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
                                        <button type="button" data-toggle="modal" data-target="#addCurso{{ $aluno->id }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('parts.modal.vincular-curso', ['aluno' => $aluno])
@stop
